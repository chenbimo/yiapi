<?php

declare(strict_types=1);

interface I_Rule {
    public function Ins(): array;

    public function Del(): array;

    public function Upd(): array;

    public function Sel(): array;

    public function Detail(): array;
}
