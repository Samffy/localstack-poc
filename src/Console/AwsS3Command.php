<?php

namespace App\Console;

use Aws\S3\S3Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class AwsS3Command extends Command
{
    protected static $defaultName = 'aws:s3:put';

    private $s3Client;
    private $output;

    protected function configure()
    {
        $this
            ->setDescription('Send file to the S3 demo bucket')
            ->addArgument('filePath', InputArgument::REQUIRED, 'Local file path to send in the S3 demo bucket.')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->s3Client = new S3Client([
            'endpoint' => 'http://localstack:4572',
            'use_path_style_endpoint' => true,
            'version' => 'latest',
            'region'  => 'eu-west-1',
            'credentials' => [
                'key' => $_ENV['AWS_ACCESS_KEY_ID'],
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
            ],
        ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = $input->getArgument('filePath');

        $this->listBucketFiles($output);

        $output->writeln(sprintf('<info>Send [</info>%s<info>] to AWS S3</info>', $filePath));

        $this->s3Client->putObject([
            'Bucket' => 'demo',
            'Key' => basename($filePath),
            'SourceFile' => $filePath,
        ]);

        $this->listBucketFiles($output);

        return 0;
    }

    private function listBucketFiles($output): void
    {
        $output->writeln('');

        $output->writeln('<info>List demo bucket</info>');

        $objects = $this->s3Client->listObjects([
            'Bucket' => 'demo',
        ]);

        if (\count($objects) > 0) {
            foreach ($objects['Contents'] as $object) {
                $output->writeln(sprintf(' - %s', $object['Key']));
            }
        }

        $output->writeln('');
    }
}