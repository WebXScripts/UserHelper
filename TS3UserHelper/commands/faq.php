<?php

	class faq
	{
		public static function onCommand($clientDB, $invokerid)
		{
			global $query, $application, $config;
			$query->sendMessage(1, $invokerid, "[b]Q&A Serwerowe:[/b]");
			foreach($config['commands']['faq']['questions_and_answers'] as $action => $qna) {
				$query->sendmessage(1, $invokerid, $qna['question']);
				$query->sendmessage(1, $invokerid, $qna['answer']);
				$query->sendmessage(1, $invokerid, $config['commands']['faq']['space_type']);
			}
			$query->sendmessage(1, $invokerid, $config['commands']['faq']['end_footer']);
		}
	}
