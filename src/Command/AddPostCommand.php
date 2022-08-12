<?php

declare(strict_types=1);

namespace App\Command;

use App\Utils\AddPost;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * AddPost command.
 */
class AddPostCommand extends Command
{
    public function __construct(AddPost $addPost)
    {
        parent::__construct();
        $this->addPost = $addPost;
    }
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        $parser->addArgument('title', ['required' => true]);
        $parser->addArgument('body', ['required' => true]);


        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {

        $title = $args->getArgument('title');
        $body = $args->getArgument('body');

        try {
            $post = $this->addPost->create($title, $body);
            $io->out('Successfully added the "'  . $post->title . '" post');
        } catch (\Throwable $th) {
            $io->out("Create failed: " . $th->getMessage());
        }
    }
}
