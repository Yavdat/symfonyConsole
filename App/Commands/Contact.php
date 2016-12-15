<?php

namespace App\Commands;

use App\StdIOAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class Contact extends StdIOAwareCommand
{
    private $StdInData;
    private $PreMsg;

    protected function configure()
    {
        $this
            ->setName('app:contact')
            ->addArgument('create', InputArgument::OPTIONAL,'Create contact')
            ->addArgument('update', InputArgument::OPTIONAL,'Update contact')
            ->addArgument('get', InputArgument::OPTIONAL,'Info contact')
            ->setDescription("create\n update\n delete\n contact")
            ->setHelp("This command allows you to create users...")
        ;
    }

    protected function getStdIn($stdIn)
    {
        $this->StdInData=stream_get_contents($stdIn);
    }



    protected function xml2arr($xmlData)
    {
        $xml=new \SimpleXMLElement($xmlData);
        $json=json_encode($xml);
        $array=json_decode($json, TRUE);
        return $array;
    }

    protected function prepareMessageToSend($arr, $cmd, $act)
    {
        $msg['request']=":".$cmd;
        $msg['operation']=":".$act;
        foreach ($arr['auth'] as $k=>$v)
        {
            if($k=='pass'){
                $msg['password']=":".$v;
                continue;
            }
            $msg[$k]=":".$v;
        }
        $msg['request-id']=":".$arr['id'];
        //$this->PreMsg=$msg;
        return $msg;

    }

    protected function sendMessage($preMsg)
    {
        $msg=$preMsg;
        return $msg;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output); // TODO: Change the autogenerated stub
        $data=stream_get_contents(STDIN);
        $this->StdInData=$data;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {



        //$output->writeln($this->StdInData);
        //$this->getStdIn();
        //$output->writeln(var_dump($input->getArgument('app:contact')));


            $output->writeln("create update delete contact");
//            $output->writeln(var_dump(null!==$input->getArgument('create')));
//            $output->writeln(var_dump(null!==$input->getArgument('update')));

            $arr=$this->xml2arr($this->StdInData);
//            $output->writeln(var_dump());


//        if(0!=$input->getArguments())
//        {
            if(null!==$input->getArgument('create')) {

                $output->writeln("This command create contact");
                $output->writeln($input->getFirstArgument());
                $msg=$this->prepareMessageToSend($arr,"contact","create");
                //$output->writeln(var_dump($msg));

                //$msg=$this->sendMessage($this->PreMsg);
                //$output->writeln(var_dump($msg));

            }elseif(null!==$input->getArgument('update')) {

                $output->writeln("This command update contact");

            }else{
                $output->writeln("Nothing not work");
            }


//        }


        $output->writeln([
            'Contact',
            '============',
        ]);


    }
}