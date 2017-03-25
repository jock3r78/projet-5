<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
	global $wpdb;

	$table_name  = $wpdb->prefix . "totalsoft_fonts";
	$table_name1 = $wpdb->prefix . "totalsoft_cal_1";
	$table_name2 = $wpdb->prefix . "totalsoft_cal_ids";
	$table_name3 = $wpdb->prefix . "totalsoft_cal_events";
	$table_name4 = $wpdb->prefix . "totalsoft_cal_types";
	$table_name5 = $wpdb->prefix . "totalsoft_cal_2";
	$table_name7 = $wpdb->prefix . "totalsoft_cal_3";

	$TotalSoftFontCount=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id>%d",0));
	$TotalSoftCalCount=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id>%d",0));
	$TotalSoftCalShortID=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id>%d order by id desc limit 1",0));
?>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('../CSS/totalsoft.css',__FILE__);?>">
<form method="POST" oninput="TotalSoft_Cal_Out()">
	<div class="Total_Soft_Cal_AMD">
		<a href="http://total-soft.pe.hu/calendar-event/" target="_blank" title="Click to Buy">
			<div class="Full_Version"><i class="totalsoft totalsoft-cart-arrow-down"></i><span style="margin-left:5px;">Get The Full Version</span></div>
		</a>
		<div class="Full_Version_Span">
			This is the free version of the plugin.
		</div>
		<div class="Total_Soft_Cal_AMD1"></div>
		<div class="Total_Soft_Cal_AMD2">
			<i class="Total_Soft_Help totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Click for Creating New Calendar', 'Total-Soft-Calendar' );?>"></i>
			<input type="button" name="" value="<?php echo __( 'New Calendar', 'Total-Soft-Calendar' );?> (Pro)" class="Total_Soft_Cal_AMD2_But" onclick="Total_Soft_Cal_AMD2_But1()">
		</div>
		<div class="Total_Soft_Cal_AMD3">
			<i class="Total_Soft_Help totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Click for Canceling', 'Total-Soft-Calendar' );?>"></i>
			<input type="button" value="<?php echo __( 'Cancel', 'Total-Soft-Calendar' );?>" class="Total_Soft_Cal_AMD2_But" onclick='TotalSoft_Reload()'>
		</div>
	</div>

	<table class="Total_Soft_AMMTable">
		<tr class="Total_Soft_AMMTableFR">
			<td><?php echo __( 'No', 'Total-Soft-Calendar' );?></td>
			<td><?php echo __( 'Calendar Name', 'Total-Soft-Calendar' );?></td>
			<td><?php echo __( 'Events Quantity', 'Total-Soft-Calendar' );?></td>
			<td><?php echo __( 'Actions', 'Total-Soft-Calendar' );?></td>
		</tr>
	</table>

	<table class="Total_Soft_AMOTable">
	 	<?php for($i=0;$i<count($TotalSoftCalCount);$i++){
	 		$TotalSoft_Cal_Ev=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE TotalSoftCal_EvCal=%d", $TotalSoftCalCount[$i]->id));
	 		?> 
	 		<tr>
				<td><?php echo $i+1;?></td>
				<td><?php echo $TotalSoftCalCount[$i]->TotalSoftCal_Name;?></td>
				<td><?php echo count($TotalSoft_Cal_Ev);?></td>
				<td onclick="TotalSoftCal_Edit(<?php echo $TotalSoftCalCount[$i]->id;?>)"><i class="Total_Soft_icon totalsoft totalsoft-pencil"></i></td>
				<td onclick="Total_Soft_Cal_AMD2_But1()"><i class="Total_Soft_icon totalsoft totalsoft-trash"></i></td>
			</tr>
	 	<?php }?>
	</table>
	<div style="position: relative; margin-top: 15px; width: 100%">
		<table class="Total_Soft_AMShortTable">
			<tr style="text-align:center">
				<td><?php echo __( 'Shortcode', 'Total-Soft-Calendar' );?></td>
			</tr>
			<tr>
				<td><?php echo __( 'Copy &amp; paste the shortcode directly into any WordPress post or page.', 'Total-Soft-Calendar' );?></td>
			</tr>
			<tr style="text-align:center">
				<td class="Total_Soft_Cal_ID"></td>
			</tr>
			<tr style="text-align:center">
				<td><?php echo __( 'Templete Include', 'Total-Soft-Calendar' );?></td>
			</tr>
			<tr>
				<td><?php echo __( 'Copy &amp; paste this code into a template file to include the calendar within your theme.', 'Total-Soft-Calendar' );?></td>
			</tr>
			<tr>
				<td >
					<textarea class="Total_Soft_Cal_TID" rows="3" readonly>
						
					</textarea>
				</td>
			</tr>
		</table>
	</div>
		
	<table class="Total_Soft_AMSetTable Total_Soft_AMSetTable_Main">
		<tr>
			<td><?php echo __( 'Calendar Name', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Define the calendar name, in which, the events should be placed.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_Name" class="Total_Soft_Select" required placeholder=" * <?php echo __( 'Required', 'Total-Soft-Calendar' );?>"></td>
			<td><?php echo __( 'Calendar Type', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Define the calendar type, in which, the events should be placed.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal_Type">
					<option value="Event Calendar">    <?php echo __( 'Event Calendar', 'Total-Soft-Calendar' );?>    </option>
					<option value="Simple Calendar">   <?php echo __( 'Simple Calendar', 'Total-Soft-Calendar' );?>   </option>
					<option value="Flexible Calendar"> <?php echo __( 'Flexible Calendar', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
	</table>
	<table class="Total_Soft_AMSetTable Total_Soft_AMSetTables Total_Soft_AMSetTable_1" onclick="Total_Soft_Cal_AMD2_But1()">
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'General Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'WeekDay Start', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select that day in the calendar, which must be the first in the week.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal_WDStart">
					<option value="Sun"> <?php echo __( 'Sunday', 'Total-Soft-Calendar' );?> </option>
					<option value="Mon"> <?php echo __( 'Monday', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose main background color in calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_BgCol" class="Total_Soft_Cal_Color" value=""></td>
		</tr>
		<tr>
			<td><?php echo __( 'Grid Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select grid color which divide the days in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_GrCol" class="Total_Soft_Cal_Color" value=""></td>
			<td><?php echo __( 'Grid Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the grid width, you can choose it corresponding  to your calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>			
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_GW" min="0" max="5" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_GW_Output" for="TotalSoftCal_GW"></output>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Border Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Define the main border width.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_BW" min="0" max="10" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_BW_Output" for="TotalSoftCal_BW"></output>
			</td>
			<td><?php echo __( 'Border Style', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Specify the border style: None, Solid, Dashed and Dotted.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal_BStyle">
					<option value="none">   <?php echo __( 'None', 'Total-Soft-Calendar' );?>   </option>
					<option value="solid">  <?php echo __( 'Solid', 'Total-Soft-Calendar' );?>  </option>
					<option value="dashed"> <?php echo __( 'Dashed', 'Total-Soft-Calendar' );?> </option>
					<option value="dotted"> <?php echo __( 'Dotted', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Border Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the main border color.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_BCol" class="Total_Soft_Cal_Color" value=""></td>
			<td><?php echo __( 'Box Shadow Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select shadow color, which allows to show the shadow color of the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_BSCol" class="Total_Soft_Cal_Color" value=""></td>
		</tr>
		<tr>
			<td><?php echo __( 'Max Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Define the calendar width.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_MW" min="150" max="1000" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_MW_Output" for="TotalSoftCal_MW"></output>
			</td>
			<td><?php echo __( 'Numbers Position', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Mention, the days in calendar must be from right or from left.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal_NumPos">
					<option value="left">  <?php echo __( 'Left', 'Total-Soft-Calendar' );?>  </option>
					<option value="right"> <?php echo __( 'Right', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Header Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a background color, where can be seen the year and month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_HBgCol" class="Total_Soft_Cal_Color" value=""></td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a text color, where can be seen the year and month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_HCol" class="Total_Soft_Cal_Color" value=""></td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the text size by pixel.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_HFS" min="8" max="36" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_HFS_Output" for="TotalSoftCal_HFS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the calendar font family of the year and month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal_HFF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Weekday Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a background color for weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_WBgCol" class="Total_Soft_Cal_Color" value=""></td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the calendar text color for the weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_WCol" class="Total_Soft_Cal_Color" value=""></td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the calendar text size for the weekdays.', 'Total-Soft-Calendar' );?> "></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_WFS" min="8" max="36" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_WFS_Output" for="TotalSoftCal_WFS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family of the weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal_WFF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Line After Weekday', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Determine the weeks and days dividing line width.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_LAW" min="0" max="5" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_LAW_Output" for="TotalSoftCal_LAW"></output>
			</td>
			<td><?php echo __( 'Style', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Indicate the dividing line style: None, Solid, Dashed and Dotted.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal_LAWS">
					<option value="none">   <?php echo __( 'None', 'Total-Soft-Calendar' );?>   </option>
					<option value="solid">  <?php echo __( 'Solid', 'Total-Soft-Calendar' );?>  </option>
					<option value="dashed"> <?php echo __( 'Dashed', 'Total-Soft-Calendar' );?> </option>
					<option value="dotted"> <?php echo __( 'Dotted', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color according to your preference.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_LAWC" class="Total_Soft_Cal_Color" value=""></td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Days Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the background for days of the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_DBgCol" class="Total_Soft_Cal_Color" value=""></td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the color of the numbers.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_DCol" class="Total_Soft_Cal_Color" value=""></td>
		</tr>
		<tr>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Note the size of the numbers, it is fully responsive.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_DFS" min="8" max="25" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_DFS_Output" for="TotalSoftCal_DFS"></output>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Todays Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Note the background color of the day.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_TBgCol" class="Total_Soft_Cal_Color" value=""></td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the date color, that will be displayed.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_TCol" class="Total_Soft_Cal_Color" value=""></td>
		</tr>
		<tr>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the size of the numbers by pixels.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_TFS" min="8" max="25" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_TFS_Output" for="TotalSoftCal_TFS"></output>
			</td>
			<td><?php echo __( "Number's Background Color", 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the background color of the day, it is designed for the frame.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_TNBgCol" class="Total_Soft_Cal_Color" value=""></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Hover Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Determine the background color of the hover option, without clicking you can change the background color of the day.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_HovBgCol" class="Total_Soft_Cal_Color" value=""></td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( "Determine the color of the hover's letters.", 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_HovCol" class="Total_Soft_Cal_Color" value=""></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Refresh Icon Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a color for updating icon, which has intended to return to the calendar from the events.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_RefIcCol" class="Total_Soft_Cal_Color" value=""></td>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a size for updating icon, which has intended to return to the calendar from the events.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_RefIcSize" min="8" max="25" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_RefIcSize_Output" for="TotalSoftCal_RefIcSize"></output>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Arrows Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Choose Icon', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the right and the left icons, which are for change the months by sequence.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal_ArrowType">
					<option value="1">  <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 1  </option>
					<option value="2">  <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 2  </option>
					<option value="3">  <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 3  </option>
					<option value="4">  <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 4  </option>
					<option value="5">  <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 5  </option>
					<option value="6">  <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 6  </option>
					<option value="7">  <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 7  </option>
					<option value="8">  <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 8  </option>
					<option value="9">  <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 9  </option>
					<option value="10"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 10 </option>
					<option value="11"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 11 </option>
				</select>
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select a color of the icon.', 'Total-Soft-Calendar' );?>"></i></td>
			<td><input type="text" name="" id="TotalSoftCal_ArrowCol" class="Total_Soft_Cal_Color" value=""></td>
		</tr>
		<tr>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the size.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal_ArrowSize" min="8" max="25" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal_ArrowSize_Output" for="TotalSoftCal_ArrowSize"></output>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Event Part', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Title Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font size of the event title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal1_Ev_T_FS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal1_Ev_T_FS_Output" for="TotalSoftCal1_Ev_T_FS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family for the title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal1_Ev_T_FF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color for the event title in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal1_Ev_T_C" class="Total_Soft_Cal_Color1" value="">
			</td>
			<td><?php echo __( 'Text Align', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Left, Right & Center - Determine the alignment of the event title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal1_Ev_T_TA">
					<option value='left'>   <?php echo __( 'Left', 'Total-Soft-Calendar' );?>   </option>
					<option value='right'>  <?php echo __( 'Right', 'Total-Soft-Calendar' );?>  </option>
					<option value='center'> <?php echo __( 'Center', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Time Format', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose time format for the event in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal1_Ev_TiF">
					<option value='24'> <?php echo __( '24 hours', 'Total-Soft-Calendar' );?> </option>
					<option value='12'> <?php echo __( '12 hours', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Description Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the text size for the description.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal1_Ev_D_FS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal1_Ev_D_FS_Output" for="TotalSoftCal1_Ev_D_FS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family of the description.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal1_Ev_D_FF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color for the event description in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal1_Ev_D_C" class="Total_Soft_Cal_Color1" value="">
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Image/Video Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the width for Video (YouTube and Vimeo) or Image, you can choose it corresponding to your calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangeper" name="" id="TotalSoftCal1_Ev_I_W" min="30" max="98" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal1_Ev_I_W_Output" for="TotalSoftCal1_Ev_I_W"></output>
			</td>
			<td><?php echo __( 'Position', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose position for the Video and Image in event.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal1_Ev_I_Pos">
					<option value='before'> <?php echo __( 'After Title', 'Total-Soft-Calendar' );?>       </option>
					<option value='after'>  <?php echo __( 'After Description', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
	</table>
	<table class="Total_Soft_AMSetTable Total_Soft_AMSetTables Total_Soft_AMSetTable_2">
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'General Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'WeekDay Start', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select that day in the calendar, which must be the first in the week.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_WDStart">
					<option value="0"> <?php echo __( 'Sunday', 'Total-Soft-Calendar' );?> </option>
					<option value="1"> <?php echo __( 'Monday', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
			<td><?php echo __( 'Border Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Define the main border width.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_BW" min="0" max="5" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_BW_Output" for="TotalSoftCal2_BW"></output>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Border Style', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Specify the border style: None, Solid, Dashed and Dotted.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_BS">
					<option value="none">   <?php echo __( 'None', 'Total-Soft-Calendar' );?>   </option>
					<option value="solid">  <?php echo __( 'Solid', 'Total-Soft-Calendar' );?>  </option>
					<option value="dashed"> <?php echo __( 'Dashed', 'Total-Soft-Calendar' );?> </option>
					<option value="dotted"> <?php echo __( 'Dotted', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
			<td><?php echo __( 'Border Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the main border color.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_BC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Max-Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Define the calendar width.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_W" min="150" max="1200" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_W_Output" for="TotalSoftCal2_W"></output>
			</td>
			<td><?php echo __( 'Height', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Define the calendar height.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_H" min="300" max="1200" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_H_Output" for="TotalSoftCal2_H"></output>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Box Shadow', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose to show the boxshadow or no.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_BxShShow">
					<option value="Yes"> <?php echo __( 'Yes', 'Total-Soft-Calendar' );?> </option>
					<option value="No">  <?php echo __( 'No', 'Total-Soft-Calendar' );?>  </option>
				</select>
			</td>
			<td><?php echo __( 'Shadow Type', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the shadow type.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_BxShType">
					<option value="1"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 1 </option>
					<option value="2"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 2 </option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Shadow', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the shadow size for the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_BxSh" min="0" max="50" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_BxSh_Output" for="TotalSoftCal2_BxSh"></output>
			</td>
			<td><?php echo __( 'Shadow Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select shadow color, which allows to show the shadow color of the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_BxShC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Calendar Part', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Header Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select a background color, where can be seen the year and month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_MBgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select a text color, where can be seen the year and month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_MC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the text size by pixel.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_MFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_MFS_Output" for="TotalSoftCal2_MFS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the calendar font family of the year and month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_MFF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'WeekDay Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a background color for weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_WBgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the calendar text color for the weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_WC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the calendar text size for the weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_WFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_WFS_Output" for="TotalSoftCal2_WFS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family of the weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_WFF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Line After WeekDay', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Determine the weeks and days dividing line width.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_LAW_W" min="0" max="3" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_LAW_W_Output" for="TotalSoftCal2_LAW_W"></output>
			</td>
			<td><?php echo __( 'Style', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Indicate the dividing line style: None, Solid, Dashed and Dotted.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_LAW_S">
					<option value="none">   <?php echo __( 'None', 'Total-Soft-Calendar' );?>   </option>
					<option value="solid">  <?php echo __( 'Solid', 'Total-Soft-Calendar' );?>  </option>
					<option value="dashed"> <?php echo __( 'Dashed', 'Total-Soft-Calendar' );?> </option>
					<option value="dotted"> <?php echo __( 'Dotted', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color according to your preference.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_LAW_C" class="Total_Soft_Cal_Color" value="">
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Days Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the background for days of the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_DBgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the color of the numbers.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_DC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Note the size of the numbers, it is fully responsive.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_DFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_DFS_Output" for="TotalSoftCal2_DFS"></output>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Todays Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Note the background color of the current day.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_TdBgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the current date color, that will be displayed.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_TdC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the size of the numbers by pixels.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_TdFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_TdFS_Output" for="TotalSoftCal2_TdFS"></output>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Event Days Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the background for event days.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_EdBgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the color of the numbers.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_EdC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Note the size of the numbers, it is fully responsive.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_EdFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_EdFS_Output" for="TotalSoftCal2_EdFS"></output>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Hover Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Determine the background color of the hover option, without clicking you can change the background color of the day.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_HBgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( "Determine the color of the hover's letters.", 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_HC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Arrows Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Type', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the right and the left icons for calendar, which are for change the months by sequence.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_ArrType">
					<option value='angle-double'>   <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 1  </option>
					<option value='angle'>          <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 2  </option>
					<option value='arrow-circle'>   <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 3  </option>
					<option value='arrow-circle-o'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 4  </option>
					<option value='arrow'>          <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 5  </option>
					<option value='caret'>          <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 6  </option>
					<option value='caret-square-o'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 7  </option>
					<option value='chevron-circle'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 8  </option>
					<option value='chevron'>        <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 9  </option>
					<option value='hand-o'>         <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 10 </option>
					<option value='long-arrow'>     <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 11 </option>
				</select>
			</td>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the size for icon.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_ArrFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_ArrFS_Output" for="TotalSoftCal2_ArrFS"></output>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select a color of the icon.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_ArrC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Other Months Days Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the background color for the other months days on the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_OmBgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the text color of the other months days.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_OmC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the size for the other months days on the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_OmFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_OmFS_Output" for="TotalSoftCal2_OmFS"></output>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Event Part', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Header Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the background color of event part header, where can be seen the events main title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_Ev_HBgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the text color of event part header, where can be seen the events main title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_Ev_HC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the text size by pixel.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_Ev_HFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_Ev_HFS_Output" for="TotalSoftCal2_Ev_HFS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_Ev_HFF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Text', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'You can write events main title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" class="Total_Soft_Select" name="" id="TotalSoftCal2_Ev_HText" value="">
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Body Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a background color for events.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_Ev_BBgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Title Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color for the event title in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_Ev_TC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family for the title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_Ev_TFF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font size of the event title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_Ev_TFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_Ev_TFS_Output" for="TotalSoftCal2_Ev_TFS"></output>
			</td>
			<td><?php echo __( 'Text Align', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Left, Right & Center - Determine the alignment of the event title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_Ev_T_TA">
					<option value='left'>   <?php echo __( 'Left', 'Total-Soft-Calendar' );?>   </option>
					<option value='right'>  <?php echo __( 'Right', 'Total-Soft-Calendar' );?>  </option>
					<option value='center'> <?php echo __( 'Center', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Time Format', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose time format for the event in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_Ev_TiF">
					<option value='24'> <?php echo __( '24 hours', 'Total-Soft-Calendar' );?> </option>
					<option value='12'> <?php echo __( '12 hours', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Description Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color for the event description in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal2_Ev_DC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family of the description.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_Ev_DFF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the text size for the description.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal2_Ev_DFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_Ev_DFS_Output" for="TotalSoftCal2_Ev_DFS"></output>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Image/Video Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the width for Video (YouTube and Vimeo) or Image, you can choose it corresponding to your calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangeper" name="" id="TotalSoftCal2_Ev_I_W" min="30" max="98" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal2_Ev_I_W_Output" for="TotalSoftCal2_Ev_I_W"></output>
			</td>
			<td><?php echo __( 'Position', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose position for the Video and Image in event.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal2_Ev_I_Pos">
					<option value='before'> <?php echo __( 'After Title', 'Total-Soft-Calendar' );?>  </option>
					<option value='after'> <?php echo __( 'After Description', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
	</table>
	<table class="Total_Soft_AMSetTable Total_Soft_AMSetTables Total_Soft_AMSetTable_3">
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'General Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Max-Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Possibility define the calendar width', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_MW" min="150" max="1200" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_MW_Output" for="TotalSoftCal3_MW"></output>
			</td>
			<td><?php echo __( 'WeekDay Start', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select that day in the calendar, which must be the first in the week.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_WDStart">
					<option value="0"> <?php echo __( 'Sunday', 'Total-Soft-Calendar' );?> </option>
					<option value="1"> <?php echo __( 'Monday', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Can choose main background color.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_BgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Grid Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select grid color which divide the days in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_GrC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Body Border Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the body border color.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_BBC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Box Shadow', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose to show the boxshadow or no.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_BoxShShow">
					<option value="Yes"> <?php echo __( 'Yes', 'Total-Soft-Calendar' );?> </option>
					<option value="No">  <?php echo __( 'No', 'Total-Soft-Calendar' );?>  </option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Shadow Type', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the shadow type.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_BoxShType">
					<option value="1"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 1 </option>
					<option value="2"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 2 </option>
				</select>
			</td>
			<td><?php echo __( 'Shadow', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the shadow size for the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_BoxSh" min="0" max="50" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_BoxSh_Output" for="TotalSoftCal3_BoxSh"></output>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Shadow Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select shadow color, which allows to show the shadow color of the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_BoxShC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Header Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select a background color, where can be seen the year and month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_H_BgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Border-Top Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the main top border width.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_H_BTW" min="0" max="10" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_H_BTW_Output" for="TotalSoftCal3_H_BTW"></output>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Border-Top Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the main top border color.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_H_BTC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the calendar font family of the year and month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_H_FF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Month Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the calendar font size of the month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_H_MFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_H_MFS_Output" for="TotalSoftCal3_H_MFS"></output>
			</td>
			<td><?php echo __( 'Month Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the calendar text color for the month.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_H_MC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Year Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the calendar font size of the year.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_H_YFS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_H_YFS_Output" for="TotalSoftCal3_H_YFS"></output>
			</td>
			<td><?php echo __( 'Year Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the calendar text color for the year.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_H_YC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Format', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose position for the month and year.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_H_Format">
					<option value="1"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 1 </option>
					<option value="2"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 2 </option>
					<option value="3"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 3 </option>
					<option value="4"> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 4 </option>
				</select>
			</td>		
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Arrows Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Type', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the right and the left icons for calendar, which are for change the months by sequence.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Arr_Type">
					<option value='angle-double'>   <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 1  </option>
					<option value='angle'>          <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 2  </option>
					<option value='arrow-circle'>   <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 3  </option>
					<option value='arrow-circle-o'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 4  </option>
					<option value='arrow'>          <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 5  </option>
					<option value='caret'>          <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 6  </option>
					<option value='caret-square-o'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 7  </option>
					<option value='chevron-circle'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 8  </option>
					<option value='chevron'>        <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 9  </option>
					<option value='hand-o'>         <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 10 </option>
					<option value='long-arrow'>     <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 11 </option>
				</select>
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select a color of the icon.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Arr_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the size for icon.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Arr_S" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Arr_S_Output" for="TotalSoftCal3_Arr_S"></output>
			</td>
			<td><?php echo __( 'Hover Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select a hover color of the icon.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Arr_HC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Line After Header', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Determine the header line width.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_LAH_W" min="0" max="5" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_LAH_W_Output" for="TotalSoftCal3_LAH_W"></output>
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color according to your preference.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_LAH_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'WeedDay Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a background color for weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_WD_BgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the calendar text color for the weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_WD_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the calendar text size for the weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_WD_FS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_WD_FS_Output" for="TotalSoftCal3_WD_FS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family of the weekdays.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_WD_FF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Days Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the background color for days of the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_D_BgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the color of the numbers.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_D_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Todays Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Note the background color of the current day.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_TD_BgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the current date color, that will be displayed.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_TD_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Hover Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Determine the background color of the hover option, without clicking you can change the background color of the day.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_HD_BgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( "Determine the color of the hover's letters.", 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_HD_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Event Days Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the event color for days.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_ED_C" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Hover Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the event hover color for days.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_ED_HC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Event Part', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Header Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Format', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose date format.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_Format">
					<option value='1'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 1 </option>
					<option value='2'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 2 </option>
					<option value='3'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 3 </option>
				</select>
			</td>
			<td><?php echo __( 'Border-Top Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the main top border width for the event.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_BTW" min="0" max="10" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_BTW_Output" for="TotalSoftCal3_Ev_BTW"></output>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Border-Top Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the main top border color for the event.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_BTC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the background color of event part header, where can be seen the events main title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_BgC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the text color of event part header, where can be seen the events main title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_C" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font size for event in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_FS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_FS_Output" for="TotalSoftCal3_Ev_FS"></output>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family for event in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_FF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Close Icon Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Type', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the close icons for calendar, which has intended to return to the calendar from the events.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_C_Type">
					<option value='times-circle-o'> <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 1 </option>
					<option value='times-circle'>   <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 2 </option>
					<option value='times'>          <?php echo __( 'Type', 'Total-Soft-Calendar' );?> 3 </option>
				</select>
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a color for close icon, which has intended to return to the calendar from the events.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_C_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Hover Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a hover color for close icon, which has intended to return to the calendar from the events.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_C_HC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the size for icon.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_C_FS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_C_FS_Output" for="TotalSoftCal3_Ev_C_FS"></output>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Line After Header', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Determine the line width for the events.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_LAH_W" min="0" max="5" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_LAH_W_Output" for="TotalSoftCal3_Ev_LAH_W"></output>
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color according to your preference.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_LAH_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Body Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Can choose main background color.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_B_BgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Border Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the body border color in the event.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_B_BC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Title Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font size of the event title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_T_FS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_T_FS_Output" for="TotalSoftCal3_Ev_T_FS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family for the title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_T_FF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Background Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose a background color for events title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_T_BgC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color for the event title in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_T_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Text Align', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Left, Right & Center - Determine the alignment of the event title.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_T_TA">
					<option value='left'>   <?php echo __( 'Left', 'Total-Soft-Calendar' );?>   </option>
					<option value='right'>  <?php echo __( 'Right', 'Total-Soft-Calendar' );?>  </option>
					<option value='center'> <?php echo __( 'Center', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
			<td><?php echo __( 'Time Format', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose time format for the event in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_TiF">
					<option value='24'> <?php echo __( '24 hours', 'Total-Soft-Calendar' );?> </option>
					<option value='12'> <?php echo __( '12 hours', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Description Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the text size for the description.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_D_FS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_D_FS_Output" for="TotalSoftCal3_Ev_D_FS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family of the description.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_D_FF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color for the event description in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_D_C" class="Total_Soft_Cal_Color" value="">
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Image/Video Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Select the width for Video (YouTube and Vimeo) or Image, you can choose it corresponding to your calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangeper" name="" id="TotalSoftCal3_Ev_I_W" min="30" max="98" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_I_W_Output" for="TotalSoftCal3_Ev_I_W"></output>
			</td>
			<td><?php echo __( 'Position', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose position for the Video and Image in event.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_I_Pos">
					<option value='1'> <?php echo __( 'Before Title', 'Total-Soft-Calendar' );?>      </option>
					<option value='2'> <?php echo __( 'After Title', 'Total-Soft-Calendar' );?>       </option>
					<option value='3'> <?php echo __( 'After Description', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Link Options', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color for the event link in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_L_C" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Hover Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the hover color for the event link in the calendar.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_L_HC" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Position', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose position for the link in event.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_L_Pos">
					<option value='1'> <?php echo __( 'Before Title', 'Total-Soft-Calendar' );?>           </option>
					<option value='2'> <?php echo __( 'After Title', 'Total-Soft-Calendar' );?>            </option>
					<option value='3'> <?php echo __( 'After Title Text', 'Total-Soft-Calendar' );?>       </option>
					<option value='4'> <?php echo __( 'After Description', 'Total-Soft-Calendar' );?>      </option>
					<option value='5'> <?php echo __( 'After Description Text', 'Total-Soft-Calendar' );?> </option>
				</select>
			</td>
			<td><?php echo __( 'Text', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'You can write link text.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_L_Text" class="Total_Soft_Select" placeholder="<?php echo __( 'Link Text', 'Total-Soft-Calendar' );?>">
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Font Size', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the text font size for the link button of the event.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_L_FS" min="8" max="48" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_L_FS_Output" for="TotalSoftCal3_Ev_L_FS"></output>
			</td>
			<td><?php echo __( 'Font Family', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the font family for the link button.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<select class="Total_Soft_Select" name="" id="TotalSoftCal3_Ev_L_FF">
					<?php foreach ($TotalSoftFontCount as $Font_Family) :?>
						<option value='<?php echo $Font_Family->Font;?>'><?php echo $Font_Family->Font;?></option>
					<?php endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Border Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Determine the border color, which is designed for Link button.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_L_BC" class="Total_Soft_Cal_Color" value="">
			</td>
			<td><?php echo __( 'Border Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Set the border width for the link buttons.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_L_BW" min="0" max="5" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_L_BW_Output" for="TotalSoftCal3_Ev_L_BW"></output>
			</td>
		</tr>
		<tr>
			<td><?php echo __( 'Border Radius', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Install the border radius for event link. ', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_L_BR" min="0" max="50" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_L_BR_Output" for="TotalSoftCal3_Ev_L_BR"></output>
			</td>
			<td colspan="2"></td>
		</tr>
		<tr class="Total_Soft_Titles">
			<td colspan="4"><?php echo __( 'Line After Each Event', 'Total-Soft-Calendar' );?></td>			
		</tr>
		<tr>
			<td><?php echo __( 'Width', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Determine the line width.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="range" class="TotalSoft_Cal_Range TotalSoft_Cal_Rangepx" name="" id="TotalSoftCal3_Ev_LAE_W" min="0" max="5" value="">
				<output class="TotalSoft_Out" name="" id="TotalSoftCal3_Ev_LAE_W_Output" for="TotalSoftCal3_Ev_LAE_W"></output>
			</td>
			<td><?php echo __( 'Color', 'Total-Soft-Calendar' );?> <i class="Total_Soft_Help1 totalsoft totalsoft-question-circle-o" title="<?php echo __( 'Choose the color according to your preference.', 'Total-Soft-Calendar' );?>"></i></td>
			<td>
				<input type="text" name="" id="TotalSoftCal3_Ev_LAE_C" class="Total_Soft_Cal_Color" value="">
			</td>
		</tr>
	</table>	
</form>