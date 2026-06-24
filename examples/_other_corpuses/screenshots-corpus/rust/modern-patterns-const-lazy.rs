use std::num::NonZeroUsize;
use std::sync::{LazyLock, OnceLock};

const CHUNK_SIZE: usize = const { 4 * 1024 };
static DEFAULT_LIMIT: LazyLock<NonZeroUsize> = LazyLock::new(|| NonZeroUsize::new(CHUNK_SIZE).unwrap());
static CONFIG: OnceLock<Config> = OnceLock::new();

#[derive(Debug, Clone)]
struct Config {
    limit: NonZeroUsize,
    mode: Mode,
}

#[derive(Debug, Clone, Copy, PartialEq, Eq)]
enum Mode {
    Fast,
    Safe,
    DryRun,
}

#[derive(Debug)]
enum Command<'a> {
    Upload { bucket: &'a str, key: &'a str },
    Delete(&'a str),
    Inspect,
}

macro_rules! command {
    (upload $bucket:literal / $key:literal) => {
        Command::Upload {
            bucket: $bucket,
            key: $key,
        }
    };
    (delete $path:literal) => {
        Command::Delete($path)
    };
    (inspect) => {
        Command::Inspect
    };
}

fn configure(mode: Option<&str>, limit: Option<usize>) -> &'static Config {
    CONFIG.get_or_init(|| Config {
        limit: limit.and_then(NonZeroUsize::new).unwrap_or(*DEFAULT_LIMIT),
        mode: match mode {
            Some("fast") => Mode::Fast,
            Some("dry-run" | "check") => Mode::DryRun,
            _ => Mode::Safe,
        },
    })
}

fn parse(input: &str) -> Option<Command<'_>> {
    let parts: Vec<_> = input.split_whitespace().collect();
    let [verb, rest @ ..] = parts.as_slice() else {
        return None;
    };

    match (verb, rest) {
        ("inspect", []) => Some(Command::Inspect),
        ("delete", [path]) if path.starts_with('/') => Some(Command::Delete(*path)),
        ("upload", [bucket, key]) if !bucket.is_empty() && !key.is_empty() => {
            Some(Command::Upload { bucket: *bucket, key: *key })
        }
        _ => None,
    }
}

fn main() {
    let config = configure(Some("dry-run"), Some(8192));
    let commands = [
        command!(inspect),
        command!(upload "assets" / "theme-preview.png"),
        command!(delete "/tmp/theme-cache"),
    ];

    for command in commands {
        println!("{config:?}: {command:?}");
    }
}
