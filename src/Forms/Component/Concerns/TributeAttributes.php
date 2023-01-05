<?php

namespace ArtMin96\FilamentTributeJs\Forms\Component\Concerns;

use Closure;

trait TributeAttributes
{
    protected string | Closure $endpoint = "/mention/users";

    /**
     * Class added in the flyout menu for active item.
     */
    protected string | Closure $selectClass = 'highlight';

    /**
     * Class added to the menu container.
     */
    protected string | Closure $containerClass = 'tribute-container';

    /**
     * Class added to each list item.
     */
    protected string | Closure $itemClass = '';

    /**
     * Column that contains the content to insert by default.
     */
    protected string | Closure $fillAttr = '';

    /**
     * Column to search against in the object (accepts function or string).
     */
    protected string | Closure $lookup = '';

    /**
     * Specify whether a space is allowed in the middle of mentions.
     */
    protected bool | Closure $allowSpaces = false;

    /**
     * Optionally specify a custom suffix for the replace text
     * (defaults to empty space if undefined)
     */
    protected string | Closure $replaceTextSuffix = '&nbsp;';

    /**
     * Specify whether a space is required before the trigger string.
     */
    protected bool | Closure $requireLeadingSpace = true;

    /**
     * Specify whether the menu should be positioned.  Set to false and use in conjuction with menuContainer to create an inline menu.
     */
    protected bool | Closure $positionMenu = true;

    /**
     * When the spacebar is hit, select the current match.
     */
    protected bool | Closure $spaceSelectsMatch = false;

    /**
     * Turn tribute into an autocomplete.
     */
    protected bool | Closure $autocompleteMode = false;

    /**
     * Limits the number of items in the menu.
     */
    protected int | Closure $menuItemLimit = 25;

    /**
     * Specify the minimum number of characters that must be typed before menu appears.
     */
    protected int | Closure $menuShowMinLength = 0;

    public function selectClass(string | Closure $selectClass): static
    {
        $this->selectClass = $selectClass;

        return $this;
    }

    public function getSelectClass(): string
    {
        return $this->evaluate($this->selectClass);
    }

    public function containerClass(string | Closure $containerClass): static
    {
        $this->containerClass = $containerClass;

        return $this;
    }

    public function getContainerClass(): string
    {
        return $this->evaluate($this->containerClass);
    }

    public function itemClass(string | Closure $itemClass): static
    {
        $this->itemClass = $itemClass;

        return $this;
    }

    public function getItemClass(): string
    {
        return $this->evaluate($this->itemClass);
    }

    public function endpoint(string | Closure $endpoint): static
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function getEndpoint(): string
    {
        return $this->evaluate($this->endpoint);
    }

    public function allowSpaces(bool | Closure $allowSpaces): static
    {
        $this->allowSpaces = $allowSpaces;

        return $this;
    }

    public function getAllowSpaces(): ?string
    {
        return $this->evaluate($this->allowSpaces);
    }

    public function replaceTextSuffix(string | Closure $replaceTextSuffix): static
    {
        $this->replaceTextSuffix = $replaceTextSuffix;

        return $this;
    }

    public function getReplaceTextSuffix(): ?string
    {
        return $this->evaluate($this->replaceTextSuffix);
    }

    public function requireLeadingSpace(bool | Closure $requireLeadingSpace): static
    {
        $this->requireLeadingSpace = $requireLeadingSpace;

        return $this;
    }

    public function getRequireLeadingSpace(): ?string
    {
        return $this->evaluate($this->requireLeadingSpace);
    }

    public function positionMenu(bool | Closure $positionMenu): static
    {
        $this->positionMenu = $positionMenu;

        return $this;
    }

    public function getPositionMenu(): ?string
    {
        return $this->evaluate($this->positionMenu);
    }

    public function spaceSelectsMatch(bool | Closure $spaceSelectsMatch): static
    {
        $this->spaceSelectsMatch = $spaceSelectsMatch;

        return $this;
    }

    public function getSpaceSelectsMatch(): ?string
    {
        return $this->evaluate($this->spaceSelectsMatch);
    }

    public function autocompleteMode(bool | Closure $autocompleteMode): static
    {
        $this->autocompleteMode = $autocompleteMode;

        return $this;
    }

    public function getAutocompleteMode(): ?string
    {
        return $this->evaluate($this->autocompleteMode);
    }

    public function menuItemLimit(int | Closure $menuItemLimit): static
    {
        $this->menuItemLimit = $menuItemLimit;

        return $this;
    }

    public function getMenuItemLimit(): ?string
    {
        return $this->evaluate($this->menuItemLimit);
    }

    public function menuShowMinLength(int | Closure $menuShowMinLength = 1): static
    {
        $this->menuShowMinLength = $menuShowMinLength;

        return $this;
    }

    public function getMenuShowMinLength(): ?string
    {
        return $this->evaluate($this->menuShowMinLength);
    }

    public function fillAttr(string | Closure $fillAttr): static
    {
        $this->fillAttr = $fillAttr;

        return $this;
    }

    public function getFillAttr(): ?string
    {
        return $this->evaluate($this->fillAttr);
    }

    public function lookup(string | Closure $lookup): static
    {
        $this->lookup = $lookup;

        return $this;
    }

    public function getLookup(): ?string
    {
        return $this->evaluate($this->lookup);
    }
}
