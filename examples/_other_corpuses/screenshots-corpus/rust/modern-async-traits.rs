use std::collections::HashMap;
use std::fmt::{self, Display};
use std::sync::LazyLock;
use std::time::Duration;

static ROUTES: LazyLock<HashMap<&'static str, Endpoint>> = LazyLock::new(|| {
    HashMap::from([
        ("/health", Endpoint::Health),
        ("/users/:id", Endpoint::UserProfile),
        ("/events", Endpoint::EventStream),
    ])
});

#[derive(Debug, Clone, Copy, PartialEq, Eq, Hash)]
enum Endpoint {
    Health,
    UserProfile,
    EventStream,
}

#[derive(Debug)]
struct Request<'a> {
    path: &'a str,
    trace_id: Option<&'a str>,
}

#[derive(Debug)]
struct Response<T> {
    status: u16,
    body: T,
}

#[derive(Debug)]
enum RouteError {
    Empty,
    Unknown(String),
}

impl Display for RouteError {
    fn fmt(&self, f: &mut fmt::Formatter<'_>) -> fmt::Result {
        match self {
            Self::Empty => f.write_str("request path is empty"),
            Self::Unknown(path) => write!(f, "unknown route: {path}"),
        }
    }
}

trait Handler {
    async fn handle<'a>(&self, request: Request<'a>) -> Result<Response<String>, RouteError>;

    fn routes(&self) -> impl Iterator<Item = (&'static str, Endpoint)> {
        ROUTES.iter().map(|(path, endpoint)| (*path, *endpoint))
    }
}

struct ApiHandler {
    timeout: Duration,
}

impl Handler for ApiHandler {
    async fn handle<'a>(&self, request: Request<'a>) -> Result<Response<String>, RouteError> {
        let endpoint = parse_endpoint(request.path)?;
        let trace = request.trace_id.unwrap_or("missing-trace");

        let body = async move {
            match endpoint {
                Endpoint::Health => format!("ok in {:?}", self.timeout),
                Endpoint::UserProfile => format!(r#"{{"trace":"{trace}","kind":"user"}}"#),
                Endpoint::EventStream => "event: ready\\ndata: {}".to_owned(),
            }
        }
        .await;

        Ok(Response { status: 200, body })
    }
}

fn parse_endpoint(path: &str) -> Result<Endpoint, RouteError> {
    let path = path.trim();
    let Some(first_segment) = path.split('/').find(|segment| !segment.is_empty()) else {
        return Err(RouteError::Empty);
    };

    if let Some(endpoint) = ROUTES.get(path).copied() {
        return Ok(endpoint);
    }

    match path {
        dynamic if first_segment == "users" && dynamic.matches('/').count() == 2 => {
            Ok(Endpoint::UserProfile)
        }
        other => Err(RouteError::Unknown(other.to_owned())),
    }
}
