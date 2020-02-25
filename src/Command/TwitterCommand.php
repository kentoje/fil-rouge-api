<?php 

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Abraham\TwitterOAuth\TwitterOAuth;
use Psr\Container\ContainerInterface;

class TwitterCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:twitter';

    private $container;

    public function __construct(ContainerInterface $container){
        parent::__construct();
        $this->container = $container;
}


    protected function configure()
    {
        $this->setDescription('Tweet the country ranking.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // define('CONSUMER_KEY', 'xxc');
        // define('CONSUMER_SECRET', 'xxx');
    
        // define('ACCESS_KEY','xxx');
        // define('ACCESS_SECRET','xxx);
    
        // require "vendor/autoload.php";
        // $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_KEY, ACCESS_SECRET);

        // $conn = $this->container->get('doctrine')->getConnection();
        
        // $sqlQueries = 'SELECT country.name AS country, country.img_url, country.flag ,SUM(user.score)/COUNT(user.id) AS scores FROM user INNER JOIN country ON user.id_country = country.id GROUP BY country.name, country.img_url, country.flag ORDER BY scores DESC LIMIT 3;';

        // $stmt = $conn->prepare($sqlQueries);
        // $stmt->execute();
        // $result = $stmt->fetchAll();

        // $connection->get("account/verify_credentials");
        // $tweet = "The competition goes on! \nHere is the current podium of the environmentally-friendly countries of the 2024 Olympic games.\n\n                  " . $result[0]['flag'] . "\n     " . $result[1]['flag'] . "  ╔═ ═╗\n╔═ ═╗  🥇 ║   " . $result[2]['flag'] . "\n║  🥈 ║        ╔═  ═╗\n║        ║        ║   🥉  ║\n║        ║        ║          ║";
        // $parameters = array('status' => str_replace(" ", "\xc2\xa0", $tweet));
        // $connection->post('statuses/update', $parameters);
    }
}