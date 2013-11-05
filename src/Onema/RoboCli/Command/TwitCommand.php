<?php

/*
 * This file is part of the RoboCLI Package. 
 * For the full copyright and license information, 
 * please view the LICENSE file that was distributed 
 * with this source code.
 */

namespace Onema\RoboCli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Yaml;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Http\Client;

/**
 * Description of TwitCommand
 *
 * @author Juan Manuel Torres <kinojman@gmail.com>
 * @copyright (c) 2013-2014, Juan Manuel Torres
 */
class TwitCommand extends Command
{
    
    protected function configure()
    {
        $this
            ->setName('robocli:twitt')
            ->setDescription('Twitt.')
            ->addOption(
               'message',
               null,
               InputOption::VALUE_REQUIRED,
               'Message to Twitt'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = $input->getOption('message');
        $client = $this->getClient();
        $request = $client->post('statuses/update.json', null, array(
            'status' => $message
        ));

        try {
            $data = $request->send()->json();
            $output->writeln('<info>Just tweeted the following message: '.$data['text'].'</info>');
        } catch (ClientErrorResponseException $e) {
            $output->writeln('<error>ERROR: '.$e->getMessage().'</error>');
        }
    }
    
    protected function getClient() 
    {
        $client = new Client('https://api.twitter.com/1.1');
        $auth = $this->getAuthentication();
        $oauth = new OauthPlugin($auth);
        $client->addSubscriber($oauth);
        return $client;
    }
    
    protected function getAuthentication()
    {
        $path = __DIR__.'/../../../../app/config/parameters.yml';
        $configValues = Yaml::parse($path);
        return $configValues['parameters'];
    }
}
