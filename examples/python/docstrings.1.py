class MyClass:
    def foo(self, foo: int):
        bar = 123
        baz = foo
        print(self.foo(bar))
        print(MyClass)
        print(baz)

def kitchen_sink(foo: MyClass, bar=None, /, baz=3, *args, kw_only="x", **kwargs):
    """
    One-line summary (kitchen sink docstring for syntax highlighting tests).

    Extended summary with inline markup: ``literal``, *emphasis*, **strong**,
    and a link: `Example <https://example.com>`_.

    Sphinx field list (tokens like :param/:type/:return/:rtype/:raises/...):
    :param foo: Positional-only parameter.
    :type foo: MyClass
    :param bar: Optional parameter.
    :type bar: str | None
    :param int baz: Annotated-with-type form.
    :param args: Variadic positional args.
    :type args: tuple
    :param kw_only: Keyword-only parameter.
    :type kw_only: str
    :param kwargs: Variadic keyword args.
    :type kwargs: dict

    :keyword debug: A keyword parameter (alt style).
    :keywordonly strict: Keyword-only marker (nonstandard in some setups).

    :return: True if the thing happened.
    :rtype: bool

    :returns: Alias of :return: (some tools treat it specially).
    :yields: Bytes chunks.
    :yieldtype: bytes

    :raises ValueError: If foo is negative.
    :raises RuntimeError: If the flux capacitor melts.
    :raises: Generic raise (often supported).

    :warns UserWarning: If bar is suspicious.
    :warning: Free-form warning field (varies by tool).

    :var module_var: Module-level variable (field token).
    :cvar class_var: Class variable (field token).
    :ivar inst_var: Instance variable (field token).

    :meta private:
    :meta public:
    :meta hide-value:
    :meta deprecated:

    Inline Sphinx roles (often tokenized):
      - :class:`MyClass`
      - :meth:`MyClass.method`
      - :attr:`MyClass.attr`
      - :func:`some_function`
      - :mod:`some_package.some_module`
      - :data:`SOME_CONST`
      - :exc:`ValueError`
      - :ref:`some-label`
      - :doc:`path/to/doc`
      - :term:`glossary term`
      - :pep:`8`
      - :rfc:`3986`

    Admonitions / directives (often tokenized):
    .. note::
       Note body.

    .. warning::
       Warning body.

    .. tip::
       Tip body.

    .. important::
       Important body.

    .. caution::
       Caution body.

    .. danger::
       Danger body.

    .. attention::
       Attention body.

    .. hint::
       Hint body.

    .. admonition:: Custom title
       Custom admonition body.

    Versioning directives:
    .. versionadded:: 1.2

    .. versionchanged:: 1.3
       Changed something.

    .. deprecated:: 2.0
       Use :func:`new_api` instead.

    Code blocks / literals:
    .. code-block:: python
       :linenos:
       :caption: Demo
       :name: demo-block

       def inner(x):
           \"\"\"Nested docstring\"\"\"
           return x * 2

    .. code-block:: console

       $ echo "hello"

    Math (Sphinx math directive):
    .. math::

       E = mc^2

    Tables / glossary:
    .. list-table::
       :header-rows: 1

       * - Col A
         - Col B
       * - 1
         - 2

    .. glossary::

       token
         A made-up definition.

    ------------------------------------------------------------------------
    Google style sections (often tokenized)
    Args:
        foo (int): Positional-only.
        bar (str | None, optional): Optional.
        baz (int): Regular param.
        *args (Any): Extra positional.
        kw_only (str): Keyword-only param.
        **kwargs (Any): Extra keyword.

    Returns:
        bool: Whether it worked.

    Raises:
        ValueError: If foo < 0.
        RuntimeError: If something else.

    Yields:
        bytes: Byte chunks.

    Attributes:
        inst_var (int): Instance var description.
        class_var (str): Class var description.

    Examples:
        Basic:
            >>> kitchen_sink(1)
            True

        With markup:
            >>> kitchen_sink(1, bar="x", kw_only="y")
            True

    Notes:
        - Mixed styles in one docstring are *not* recommended in real code.
        - This is only to see what your theme tokenizes.

    See Also:
        some_function: Related API.
        MyClass.method: Related method.

    Todo:
        - Add more nonsense.
        - Remove nonsense.

    ------------------------------------------------------------------------
    NumPy style sections (often tokenized)
    Parameters
    ----------
    foo : int
        Positional-only.
    bar : str or None, optional
        Optional.
    baz : int
        Regular param.
    *args : tuple
        Extra positional.
    kw_only : str
        Keyword-only.
    **kwargs : dict
        Extra keyword.

    Returns
    -------
    out : bool
        Whether it worked.

    Raises
    ------
    ValueError
        If foo < 0.
    RuntimeError
        If the flux capacitor melts.

    See Also
    --------
    numpy.array : Unrelated, but tokenized.
    some_function : Another reference.

    Notes
    -----
    This section exists only to trigger highlighting.

    References
    ----------
    .. [1] Doe, J. *Totally Fake Paper*, 2099.

    Examples
    --------
    >>> kitchen_sink(1)
    True
    """
    qux = foo
    qux = "123"
    qux = baz
    qwe = bar

    print(qux)
    
    return True
