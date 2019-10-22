<?php
namespace PoP\ApplicationWP\LooseContracts;

use PoP\Engine\LooseContracts\AbstractLooseContractResolutionSet;

class LooseContractResolutionSet extends AbstractLooseContractResolutionSet
{
    protected function resolveContracts()
    {
		$this->nameResolver->implementNames([
			'popcms:option:limit' => 'posts_per_page',
		]);
    }
}
