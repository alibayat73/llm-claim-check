<?php

require 'vendor/autoload.php';
require 'helper.php';

use OpenAI\Factory;

$apiKey = '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';

$client = new Factory()
    ->withApiKey($apiKey)
    ->withHttpHeader('Content-Type', 'application/json')
    ->withBaseUri('https://openrouter.ai/api/v1')
    ->make();

$line = getFromTerminal();

$response = $client->chat()->create([
        'model' => 'gpt-4.1-nano',
        'messages' => [
            ['role' => 'system', 'content' => "# Role\nYou are an advanced car filterer.\n# Goal\nFilter cars based on the user requirements\n#Reasoning Structure\nStart from the car with the id 1. Check conditions (Pace and Power) for it and show the result. Then go to the next car id then Check the conditions (Pace and Power) and show the result for it and then go to the next and do the checking and showing output. Check the conditions (Pace and Power) and show the reasoning output for all. Continue until the end. Show and Output each car reasoning for each item. Continue until the end of the list and do not skip anything.\n# Output\nYou **MUST** return the answer in this template:\n[reason]\n---\n[filtered array]\n filtered array **MUST** an array of the cars Id and nothing else. For example: [1, 2, 4]# Context\n<car_dataset>$what</car_dataset>"],
            ['role' => 'user', 'content' => $line],
        ],
    ]);

$final_answer = $response->choices[0]->message->content . "\n";
echo $final_answer;