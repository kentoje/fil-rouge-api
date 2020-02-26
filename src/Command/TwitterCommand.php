<?php 

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Abraham\TwitterOAuth\TwitterOAuth;
use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Dotenv;

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

        $dotenv = new Dotenv();
        $dotenv->load('./.env.local');

        define('CONSUMER_KEY', getenv('CONSUMER_KEY'));
        define('CONSUMER_SECRET', getenv('CONSUMER_SECRET'));
    
        define('ACCESS_KEY', getenv('ACCESS_KEY'));
        define('ACCESS_SECRET', getenv('ACCESS_SECRET'));
    
        require "vendor/autoload.php";
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_KEY, ACCESS_SECRET);

        $conn = $this->container->get('doctrine')->getConnection();

        switch (date("d/n/Y")) {
            case "24/2/2020":
            case "27/3/2020":
            case "1/3/2020":
            case "4/3/2020":
            case "7/3/2020":
                $connection->get("account/verify_credentials");
                $connection->setTimeouts(10000, 15000);
                $tweet = "You too join the competition #GreenParis and support the planet as well as your country to elect the city that will host the next #Olympics2028\n https://www.greenparis.com";
                $media1 = $connection->upload('media/upload', ['media' => './assets/greenparis.png']);
                $parameters = array('status' => str_replace(" ", "\xc2\xa0", $tweet),'media_ids' => $media1->media_id_string);
                // $parameters = array('status' => $tweet);
                $connection->post('statuses/update', $parameters);
                break;
            case "26/2/2020":
                $sqlQueries = 'SELECT sum(tons)*1.23*3 as tons from records_waste;';
                $stmt = $conn->prepare($sqlQueries);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $connection->get("account/verify_credentials");
                $connection->setTimeouts(10000, 15000);
                $tweet = "We are on the 3rd day of the competition of #Olympics2024 and " . $result[0]["tons"] . "  tonnes of wastes have been thrown away.";
                $media1 = $connection->upload('media/upload', ['media' => './assets/waste.png']);
                $parameters = array('status' => $tweet,'media_ids' => $media1->media_id_string);
                $connection->post('statuses/update', $parameters);
                break;
            case "28/2/2020":
                $sqlQueries = 'SELECT sum(tons)*1.23*5 as tons from records_waste;';
                $stmt = $conn->prepare($sqlQueries);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $connection->get("account/verify_credentials");
                $connection->setTimeouts(10000, 15000);
                $tweet = "We are on the 5th day of the competition of #Olympics2024 and " . $result[0]["tons"] . "  tonnes of wastes have been thrown away.";
                $media1 = $connection->upload('media/upload', ['media' => './assets/waste.png']);
                $parameters = array('status' => $tweet,'media_ids' => $media1->media_id_string);
                $connection->post('statuses/update', $parameters);
                    break;
            case "2/3/2020":  
                $sqlQueries = 'SELECT sum(tons)*1.23*8 as tons from records_waste;';
                $stmt = $conn->prepare($sqlQueries);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $connection->get("account/verify_credentials");
                $connection->setTimeouts(10000, 15000);
                $tweet = "We are on the 8th day of the competition of #Olympics2024 and " . $result[0]["tons"] . "  tonnes of wastes have been thrown away.";
                $media1 = $connection->upload('media/upload', ['media' => './assets/waste.png']);
                $parameters = array('status' => $tweet,'media_ids' => $media1->media_id_string);
                $connection->post('statuses/update', $parameters);  
                break;
            case "5/3/2020":  
                $sqlQueries = 'SELECT sum(tons)*1.23*11 as tons from records_waste;';
                $stmt = $conn->prepare($sqlQueries);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $connection->get("account/verify_credentials");
                $connection->setTimeouts(10000, 15000);
                $tweet = "We are on the 11th day of the competition of #Olympics2024 and " . $result[0]["tons"] . "  tonnes of wastes have been thrown away.";
                $media1 = $connection->upload('media/upload', ['media' => './assets/waste.png']);
                $parameters = array('status' => $tweet,'media_ids' => $media1->media_id_string);
                $connection->post('statuses/update', $parameters);  
                break;
            case "8/3/2020":  
                $sqlQueries = 'SELECT sum(tons)*1.23*14 as tons from records_waste;';
                $stmt = $conn->prepare($sqlQueries);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $connection->get("account/verify_credentials");
                $connection->setTimeouts(10000, 15000);
                $tweet = "We are on the last day of the competition of #Olympics2024 and " . $result[0]["tons"] . " tonnes of wastes have been thrown away.";
                $media1 = $connection->upload('media/upload', ['media' => './assets/waste.png']);
                $parameters = array('status' => $tweet,'media_ids' => $media1->media_id_string);
                $connection->post('statuses/update', $parameters);  
                break;
            default:
                $sqlQueries = 'SELECT country.name AS country, country.img_url, country.flag ,SUM(user.score)/COUNT(user.id) AS scores FROM user INNER JOIN country ON user.id_country = country.id GROUP BY country.name, country.img_url, country.flag ORDER BY scores DESC LIMIT 3;';
                $stmt = $conn->prepare($sqlQueries);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $connection->get("account/verify_credentials");
                $tweet = "The competition goes on! \nHere is the current podium of the environmentally-friendly countries of the 2024 Olympic games.\n\n                  " . $result[0]['flag'] . "\n     " . $result[1]['flag'] . "  ╔═ ═╗\n╔═ ═╗  🥇 ║   " . $result[2]['flag'] . "\n║  🥈 ║        ╔═  ═╗\n║        ║        ║   🥉  ║\n║        ║        ║          ║";
                $parameters = array('status' => str_replace(" ", "\xc2\xa0", $tweet));
                $connection->post('statuses/update', $parameters);
        }
    }
}