use std::borrow::Cow;
use std::error::Error;
use std::fmt::{self, Debug, Display};
use std::ops::Deref;

#[derive(Debug, Clone, PartialEq, Eq)]
struct Validated<T> {
    value: T,
    warnings: Vec<Cow<'static, str>>,
}

impl<T> Deref for Validated<T> {
    type Target = T;

    fn deref(&self) -> &Self::Target {
        &self.value
    }
}

#[derive(Debug, Clone, PartialEq, Eq)]
enum ValidationError {
    Empty,
    TooLong { max: usize, actual: usize },
    ForbiddenPrefix(String),
}

impl Display for ValidationError {
    fn fmt(&self, f: &mut fmt::Formatter<'_>) -> fmt::Result {
        match self {
            Self::Empty => f.write_str("value cannot be empty"),
            Self::TooLong { max, actual } => write!(f, "value has {actual} chars; max is {max}"),
            Self::ForbiddenPrefix(prefix) => write!(f, "value starts with forbidden prefix {prefix:?}"),
        }
    }
}

impl Error for ValidationError {}

fn validate_name<S>(raw: S) -> Result<Validated<String>, ValidationError>
where
    S: AsRef<str> + Debug,
{
    let trimmed = raw.as_ref().trim();
    let Some(first_char) = trimmed.chars().next() else {
        return Err(ValidationError::Empty);
    };

    if trimmed.len() > const { 64 } {
        return Err(ValidationError::TooLong {
            max: 64,
            actual: trimmed.len(),
        });
    }

    if matches!(first_char, '_' | '-' | '.') {
        return Err(ValidationError::ForbiddenPrefix(first_char.to_string()));
    }

    let warnings = match trimmed {
        name if name.contains("__") => vec![Cow::Borrowed("contains repeated underscores")],
        name if name.chars().any(char::is_whitespace) => vec![Cow::Borrowed("contains whitespace")],
        _ => Vec::new(),
    };

    Ok(Validated {
        value: trimmed.to_owned(),
        warnings,
    })
}

