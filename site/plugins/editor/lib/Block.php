<?php

namespace Kirby\Editor;

use InvalidArgumentException;
use Kirby\Cms\Content;
use Kirby\Cms\Field;
use Kirby\Cms\HasSiblings;

/**
 * Represents a single block
 * from the editor, which can
 * be inspected further or
 * converted to HTML
 */
class Block
{

    use HasSiblings;

    /**
     * @var Kirby\Cms\Content
     */
    protected $attrs;

    /**
     * @var Kirby\Cms\Field
     */
    protected $content;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var Kirby\Cms\Page|Kirby\Cms\Site|Kirby\Cms\User|Kirby\Cms\File
     */
    protected $parent;

    /**
     * @var Kirby\Editor\Blocks
     */
    protected $siblings;

    /**
     * @var string
     */
    protected $type;

    /**
     * Creates a new block object
     *
     * @param array $params
     * @param Kirby\Editor\Blocks $siblings
     */
    public function __construct(array $params, Blocks $siblings = null)
    {
        if (isset($params['type']) === false) {
            throw new InvalidArgumentException('The block type is missing');
        }

        if (isset($params['id']) === false) {
            throw new InvalidArgumentException('The block id is missing');
        }

        $this->attrs    = $params['attrs'] ?? [];
        $this->content  = $params['content'] ?? '';
        $this->id       = $params['id'];
        $this->parent   = $params['parent'] ?? null;
        $this->siblings = $siblings;
        $this->type     = $params['type'];

        // create content and attrs objects
        $this->attrs    = new Content($this->attrs, $this->parent);
        $this->content  = new Field($this->parent, 'content', $this->content);
    }

    /**
     * Returns the attrs object
     *
     * @return Kirby\Cms\Content
     */
    public function attrs()
    {
        return $this->attrs;
    }

    /**
     * Returns the content object
     *
     * @return Kirby\Cms\Field
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * Controller for the block snippet
     *
     * @return array
     */
    public function controller(): array
    {
        return [
            'block'   => $this,
            'content' => $this->content(),
            'attrs'   => $this->attrs(),
            'prev'    => $this->prev(),
            'next'    => $this->next()
        ];
    }

    /**
     * @return Kirby\Editor\Block
     */
    public static function factory(array $params, Blocks $blocks)
    {
        if (isset($params['type']) === false) {
            throw new InvalidArgumentException('The block type is missing');
        }

        $customName = 'Kirby\\Editor\\' . $params['type'] . 'Block';
        $className  = class_exists($customName) ? $customName : 'Kirby\\Editor\\Block';

        return new $className($params, $blocks);
    }

    /**
     * Converts the block to HTML
     *
     * @return string
     */
    public function html(): string
    {
        return snippet('editor/' . $this->type(), $this->controller(), true);
    }

    /**
     * Returns the block id
     *
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * Compares the block to another one
     *
     * @param Block $block
     * @return boolean
     */
    public function is(Block $block): bool
    {
        return $this->id() === $block->id();
    }

    /**
     * Checks if the block is empty
     *
     * @return boolean
     */
    public function isEmpty(): bool
    {
        return $this->content()->isEmpty();
    }

    /**
     * Checks if the block is not empty
     *
     * @return boolean
     */
    public function isNotEmpty(): bool
    {
        return $this->isEmpty() === false;
    }

    /**
     * Returns the Kirby instance
     *
     * @return Kirby\Cms\App
     */
    public function kirby()
    {
        return $this->parent()->kirby();
    }

    /**
     * Returns the parent model
     *
     * @return Kirby\Cms\Page | Kirby\Cms\Site | Kirby\Cms\File | Kirby\Cms\User
     */
    public function parent()
    {
        return $this->parent;
    }

    /**
     * Returns the sibling collection
     * This is required by the HasSiblings trait
     *
     * @return Kirby\Editor\Blocks
     */
    protected function siblingsCollection()
    {
        return $this->siblings;
    }

    /**
     * Returns the block type
     *
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * The result is being sent to the editor
     * via the API in the panel
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'attrs'   => $this->attrs()->toArray(),
            'content' => $this->content()->value(),
            'id'      => $this->id(),
            'type'    => $this->type(),
        ];
    }

}
