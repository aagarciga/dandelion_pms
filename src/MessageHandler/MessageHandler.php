<?php


namespace App\MessageHandler;


use App\Message\Message;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class MessageHandler
 * @package App\MessageHandler
 *
 * @author Alex Alvarez Gárciga
 */
abstract class MessageHandler implements MessageHandlerInterface
{
    abstract public function __invoke(Message $message);
}