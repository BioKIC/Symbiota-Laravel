<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
//use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

class MarkdownController extends Controller {
    public function __invoke(Request $request) {
        $path = $request->path();
        $md_path = base_path() . '/' . $path;
        if (! is_file($md_path)) {
            $md_path = base_path() . '/docs/index.md';
        }
        $markdown_str = file_get_contents($md_path);
        $markdown_options = [
            'heading_permalink' => [
                'html_class' => 'heading-permalink',
                'id_prefix' => '',
                'heading_class' => 'perma-heading',
                'apply_id_to_heading' => true,
                'insert' => 'before',
                'min_heading_level' => 1,
                'max_heading_level' => 6,
                'title' => 'Permalink',
                'symbol' => '#',
                'aria_hidden' => true,
            ],
        ];

        $converter = new DocsMarkdownConverter($markdown_options);

        //Str::markdown($markdown_str, $markdown_options)
        return view('core/markdown', [
            'markdown' => $converter->convert($markdown_str)]);
    }
}

final class DocsMarkdownConverter extends MarkdownConverter {
    /**
     * Create a new Markdown converter pre-configured for GFM
     *
     * @param  array<string, mixed>  $config
     */
    public function __construct(array $config = []) {
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new HeadingPermalinkExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());

        parent::__construct($environment);
    }

    public function getEnvironment(): Environment {
        \assert($this->environment instanceof Environment);

        return $this->environment;
    }
}
