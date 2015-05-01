<?php
/*
    Tatoeba Project, free collaborative creation of multilingual corpuses project
    Copyright (C) 2009  HO Ngoc Phuong Trang <tranglich@gmail.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>

<div id="annexe_content">
    <?php
    $sentenceAnnotations->displayGoToBox();
    
    $sentenceAnnotations->displaySearchBox();
    
    if(isset($sentence)){
        $sentenceAnnotations->displayNewIndexBox($sentence['id']);
    }
    ?>
</div>

<div id="main_content">
    <div class="module">
    <?php
    if(isset($sentence)){
        ?>
        <h2>
        <?php
        echo format(__('Sentence #{number}', true) , array('number' => $sentence['id']));
        ?>
        </h2>
        
        <p class="original">
        <?php echo $sentence['text']; ?>
        </p>
        
        <?php
        
        foreach($annotations as $annotation){
            ?>
            <hr/>
            
            <p>
            <?php echo Sanitize::html($annotation['text']); ?>
            </p>
            
            <?php
            echo $form->create('SentenceAnnotation', array("action" => "save"));
            
            // hidden ids necessary for saving
            echo '<div>';
            echo $form->hidden(
                'SentenceAnnotation.id'
                , array("value" => $annotation['id'])
            );
            echo $form->hidden(
                'SentenceAnnotation.sentence_id'
                , array("value" => $annotation['sentence_id'])
            );
            echo '</div>';
            
            // id of the "meaning" (i.e. English sentence for Tanaka sentences annotations)
            echo $form->input(
                'meaning_id', 
                array(
                    "type" => "text",
                    "value" => $annotation['meaning_id']
                )
            );
            
            // annotations text
            echo $form->textarea('text', array(
                "label" => null
                , "value" => $annotation['text']
                , "cols" => 60
                , "rows" => 3
            ));
            
            // delete link
            echo $html->link(
                'delete'
                , array(
                    "controller" => "sentence_annotations"
                    , "action" => "delete"
                    , $annotation['id']
                    , $annotation['sentence_id']
                )
                , array("style"=>"float:right")
                , 'Are you sure?'
            );          
            
            // save button
            echo $form->end('save');
        }
    }
    ?>
    </div>
</div>
