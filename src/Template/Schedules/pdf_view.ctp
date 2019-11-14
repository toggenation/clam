<?php

use App\Clam\Xtcpdf;

use Cake\Core\Configure;
// this is so we can split the Xtcpdf
// class off in to src/Clam/Xtcpdf.php
// and the autoloader will find it

$meetings_per_page = Configure::read('CLAM.meetings_per_page');
//define ('PDF_PAGE_FORMAT', 'A4');
// end class
// create new PDF document
$pdf = new Xtcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($userInfo->full_name);

$pdf->SetTitle(sprintf('Christian Life and Ministry %s %s', $schedule->month, $schedule->full_year ));
$pdf->SetSubject(sprintf('Christian Life and Ministry Schedule for  %s %s', $schedule->month, $schedule->full_year ));
$pdf->SetKeywords("CLAM CLM Schedule Program Meeting Service Meeting");

// remove default header/footer
$pdf->setPrintHeader(false);

$pdf->SetDefaultMonospacedFont('liberationmono');

// set margins l t r
$pdf->SetMargins(15, 10, 15, true);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 15);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();


$pdf->clamTitle([ Configure::read("CLAM.congregation"), Configure::read("CLAM.title"), $schedule->month, $schedule->full_year]);

// these are the functions we want to call


foreach ($pdf->getMeetingTitles() as $key => $value) {
    $complete[$key] = false;
}

if ($schedule->has('meetings')) {


    // meeting headings
    foreach ($schedule->meetings as $key => $mtg) {


			//$this->log($mtg);
				$pdf->_aux_counselor = $mtg->has('auxiliary_counselor') ? $mtg->auxiliary_counselor->full_name: null;

				$pdf->_chairman = $mtg->has('chairman') ? $mtg->chairman->full_name: null;

        $pdf->meetingTitle(
					strtoupper($this->Time->format($mtg->date, 'eeee MMMM d')),
					$pdf->_chairman,
					$pdf->_aux_counselor
				);

        // meeting parts
        if ($mtg->has('assigned')) {

            $arrayKeys = array_keys($mtg->assigned);

            // lastArrayKey == last part so add bottom border
            $lastArrayKey = array_pop($arrayKeys);

            foreach ($mtg->assigned as $j => $assigned_part) {

                // $this->log($assigned_part);
                // headings
                if ((bool) $assigned_part->part->section->heading) {

                    $stored_id = $assigned_part->part->section->id;

                    if (!$complete[$stored_id]) {

                        // this call a variable function name
                        $method_name = $pdf->getMeetingTitles($stored_id);
                        $pdf->$method_name(strtoupper($assigned_part->part->section->name));

                        $complete[$stored_id] = true; // say we have done it already
                    }
                    //not first one
                }

                $ass_id = (int) $assigned_part->part_id;

								if ( $ass_id === $pdf->bible_reading) {

										$auxTitle = "Auxiliary Classroom";
										$mainTitle = "Main Hall";

										$values = [ 'auxTitle' => $auxTitle , 'mainTitle' => $mainTitle];

									  $pdf->schoolTitle($values);
								}

								$pdf->_prefixedAssistant = !empty($assigned_part->part->assistant_prefix);

                $values = [
										'ass_id' => $ass_id,
										'has_auxliary' => $assigned_part->part->has_auxiliary,
										'has_assistant' => $assigned_part->part->assistant,
                    'time' => $this->Time->format($assigned_part->start_time, 'h:mm'),
                    'partname' => $assigned_part->part_title . ' (' . $assigned_part->minutes . ' ' . $assigned_part->part->min_suffix . ')'  ,
                    'assistant' => $assigned_part->has('assistant') ? $pdf->assistantFormat($assigned_part->assistant->full_name, $assigned_part->part->assistant_prefix) : null,
                    'assigned' => $assigned_part->has('person') ? $assigned_part->person->full_name : null,
										'aux_assigned' => $assigned_part->has('aux_assigned') ? $assigned_part->aux_assigned->full_name : null,
										'aux_assistant' => $assigned_part->has('aux_assistant') ? $assigned_part->aux_assistant->full_name : null,

                ];

								$pdf->last_record = $j === $lastArrayKey;

                $pdf->assignment($values);

            }
        }

        if ( $mtg->has('meeting_note')){

            $pdf->meetingNote([ 'heading' => $mtg->meeting_note->heading, 'note' => $mtg->meeting_note->note]);

        }

        // reset so we can print the meeting titles again
        foreach ($pdf->getMeetingTitles() as $k => $v) {
            $complete[$k] = false;
        }

        // add a page break after the 2nd meeting
        // but don't if one has been added already
        if ((int) $key === $meetings_per_page - 1 && $pdf->page_break !== true) {
            $pdf->AddPage();
            $pdf->clamTitle($pdf->_clamTitle);
        }

    }

}

$pdf->Output($file_name, 'I');

//============================================================+
// END OF FILE
//============================================================+
