<?

class Bar {

    /**
     * An example PHPDoc block. We use @param int $foo to say that parameter $foo has type int.
     * And this is a description.
     * 
     * @param int $foo Foo param description
     * @param $bar Bar param description
     *             multiline
     * @todo Allow `bar` accept {@see Bar} instance.
     *       Or not.
     * @param $baz Baz param description
     * @param int $qux Qux param description
     * 
     * @throws Exception|Error  When needed
     *                          Or not.
     * 
     * @return void Nothing.
     *              Or not.
     */
    function example($foo, $bar, $baz, $qux) {}
}
