<?php

namespace Kirby\Editor;

use Kirby\Toolkit\F;
use Throwable;

class ImageBlock extends Block
{

    public function controller(): array
    {
        $data = parent::controller();
        $data['image'] = $image = $this->image();
        $data['src']   = $image ? $image->url() : $this->attrs()->src();

        return $data;
    }

    public function image()
    {
        try {
            return $this->kirby()->api()->parent($this->attrs()->guid()->value());
        } catch (Throwable $e) {
            return null;
        }
    }

    public function isEmpty(): bool
    {
        return empty($this->image()) === true && $this->attrs()->src()->isEmpty();
    }

    public function toArray(): array
    {
        $data = parent::toArray();

        if ($image = $this->image()) {
            $data['attrs'] = array_merge($data['attrs'] ?? [], [
                'guid'  => $image->panelUrl(true),
                'ratio' => $image->ratio(),
                'src'   => $image->url(),
            ]);
        } else {
            unset($data['attrs']['guid']);
        }

        return $data;
    }

}
