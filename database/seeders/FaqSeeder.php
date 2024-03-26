<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create(['question' => 'Rebook Taskers you know: A guide for customers', 'answer' => "With Contacts, you no longer need to request quotes from past Taskers that they may never see, manually save contact details or sacrifice payment security benefits when completing future tasks directly. Simply reconnect with a Tasker you already know and on a platform you already trust. With the choice in your hands, Airtasker becomes your personal list of trusted professionals.
        A convenient, direct channel to past Taskers: Tap into an existing chat, request another task and receive an offer directly from the Tasker – all within private messages.
        Service quality you already trust: Work with Taskers who did an excellent job the first time and skip the offer vetting process.
        Airtasker is here to support you, just in case: With payment security, customer support and insurance, we’ll help create accountability."]);

        Faq::create(['question' => 'Rebook Taskers you know: A guide for customers2', 'answer' => "With Contacts, you no longer need to request quotes from past Taskers that they may never see, manually save contact details or sacrifice payment security benefits when completing future tasks directly. Simply reconnect with a Tasker you already know and on a platform you already trust. With the choice in your hands, Airtasker becomes your personal list of trusted professionals.
        A convenient, direct channel to past Taskers: Tap into an existing chat, request another task and receive an offer directly from the Tasker – all within private messages.
        Service quality you already trust: Work with Taskers who did an excellent job the first time and skip the offer vetting process.
        Airtasker is here to support you, just in case: With payment security, customer support and insurance, we’ll help create accountability."]);

        Faq::create(['question' => 'Rebook Taskers you know: A guide for customers3', 'answer' => "With Contacts, you no longer need to request quotes from past Taskers that they may never see, manually save contact details or sacrifice payment security benefits when completing future tasks directly. Simply reconnect with a Tasker you already know and on a platform you already trust. With the choice in your hands, Airtasker becomes your personal list of trusted professionals.
        A convenient, direct channel to past Taskers: Tap into an existing chat, request another task and receive an offer directly from the Tasker – all within private messages.
        Service quality you already trust: Work with Taskers who did an excellent job the first time and skip the offer vetting process.
        Airtasker is here to support you, just in case: With payment security, customer support and insurance, we’ll help create accountability."]);
    }
}
