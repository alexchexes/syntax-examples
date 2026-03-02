#!/usr/bin/env python3
# -*- coding: utf-8 -*-

# flake8: noqa
# ruff: noqa
# mypy: ignore-errors
# mypy: disable-error-code="truthy-bool, ignore-without-code"
# pyright: strict

# TODO: task marker
# FIXME: broken behavior
# BUG: reproducible defect
# XXX: ugly but works
# HACK: temporary workaround
# NOTE: important detail
# WARNING: footgun
# CAUTION: sharp edge
# REVIEW: revisit later
# OPTIMIZE: perf improvement

# region Folding (VS Code)
# endregion

import os  # noqa: F401
import sys  # noqa

x = "line too long"  # noqa: E501
y = 123  # type: ignore
z = 456  # type: ignore[assignment]

w = None  # pyright: ignore

# fmt: off
not_formatted=  3
also_not_formatted=4
# fmt: on

something = "keep this exactly"  # fmt: skip

import b
import a  # isort: skip

# isort: off
import zzz
import aaa
# isort: on

password = "hunter2"  # nosec B105

def uncovered():
    return 123  # pragma: no cover