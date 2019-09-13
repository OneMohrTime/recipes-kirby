<?php

namespace Kirby\Editor;

use Kirby\Toolkit\Str;

class H1Block extends Block
{
    public function controller(): array
    {
        $data = parent::controller();
        $data['hash']  = $this->hash();
        $data['level'] = $this->level();

        return $data;
    }

    public function hash(): string
    {
        return Str::slug($this->content());
    }

    public function level(): int
    {
        return option('kirby.editor.headingLevel', 1);
    }
}
