<?php
/****************************************************************************************

//! Script to extract a readable transcript from an Amazon Transcribe .json transcript 

why this\\  Funnily such a script was not available when searched by a friend of mine so 
I put this together so he could use Amazon Transcribe 
whoami \\ Nrip Nihalani  -http://www.nrip.in
wheredoiwork \\ Plus91 Technologies - https://www.plus91.in
whatdoiexpect \\ Hopefully someone can improve on this, as well as expand it to 
build a service around this and benefit others. 

*****************************************************************************************/

//! Lets define the input and output files here

$ip_file = 'test.json';
$op_file = 'results2.txt';


$str = file_get_contents($ip_file);

$json = json_decode($str, true);

$job_name = $json['jobName'];
$num_speakers = $json['results']['speaker_labels']['speakers'];

$a_items = $json['results']['items'];


$json_transcript = $json['results']['transcripts'][0]['transcript'];

$a_segments = $json['results']['speaker_labels']['segments'];

$num_segments = count($a_segments);

$aSegments = array();
$total_items = 0;
for($iii=0;$iii<$num_segments;$iii++)
{

//Get Each Segment

	$this_segment = $a_segments[$iii];

	//var_dump($this_segment);

	$this_segment_speaker = $this_segment['speaker_label'];
	$this_segment_starts = $this_segment['start_time'];
	$this_segment_ends = $this_segment['end_time'];
	$this_segment_items = count($this_segment['items']);

	$this_segment_spoken = "";

	for($kkk=0;$kkk<$this_segment_items;$kkk++)
	{
		$start_point = $total_items;
		$this_point = $start_point + $kkk;
		$this_word = $a_items[$this_point]['alternatives'][0]['content'];

		if($kkk == 0)
		{
			$this_segment_spoken = $this_word;
		}else{
			$this_segment_spoken = $this_segment_spoken . " " . $this_word;
		}

	}

	$total_items = $total_items + $this_segment_items;

	$this_segment__ = array();

	$this_segment__['speaker'] = $this_segment_speaker;
	$this_segment__['starts'] = $this_segment_starts;
	$this_segment__['ends'] = $this_segment_ends;

	$this_segment__['spoken_items_transcribed'] = $this_segment_spoken;

	$this_segment__['num_spoken_items'] = $this_segment_items;


	$aSegments[] = $this_segment__;

}



$newJSON = json_encode($aSegments);



$copy = "THIS IS THE TRANSCRIPTION OF JOB: {$job_name}. \nThere are $num_speakers Speakers. \n\n";
$test_write = file_put_contents($op_file, $copy, FILE_APPEND | LOCK_EX);


foreach ($aSegments as $spokenSegment)
{




$copy = "{$spokenSegment['speaker']}    :    {$spokenSegment['spoken_items_transcribed']}\n\n";

$test_write = file_put_contents($op_file, $copy, FILE_APPEND | LOCK_EX);


}




?>