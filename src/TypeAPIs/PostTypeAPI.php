<?php
namespace PoP\ApplicationWP\TypeAPIs;

use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Translation\Facades\TranslationAPIFacade;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class PostTypeAPI extends \PoP\PostsWP\TypeAPIs\PostTypeAPI
{
    public function getExcerpt($post_id): ?string
    {
        $post = $this->getPost($post_id);
	    $readmore = sprintf(
	        TranslationAPIFacade::getInstance()->__('... <a href="%s">Read more</a>', 'pop-application'),
	        $this->getPermalink($post_id)
	    );
	    $value = empty($post->post_excerpt) ? \limitString(\strip_tags(\strip_shortcodes($post->post_content)), $this->getExcerptLength(), $readmore) : $post->post_excerpt;

	    return HooksAPIFacade::getInstance()->applyFilters('get_the_excerpt', $value, $post_id);
    }
}
