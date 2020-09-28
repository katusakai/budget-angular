<?php

namespace Tests\Feature\Database;

interface TableTestInterface
{
    /**
     * Table fields existence test.
     *
     * @return void
     */
    public function testExists(): void;

    /**
     * Table records delete test.
     *
     * @return void
     */
    public function testDeleted(): void;
}
