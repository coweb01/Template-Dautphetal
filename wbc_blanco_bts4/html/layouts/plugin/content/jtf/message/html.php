<?php
/**
 * @package          Joomla.Plugin
 * @subpackage       Content.Jtf
 *
 * @author           Guido De Gobbis <support@joomtools.de>
 * @copyright    (c) 2018 JoomTools.de - All rights reserved.
 * @license          GNU General Public License version 3 or later
 */

defined('_JEXEC') or die;

extract($displayData);

/**
 * Layout variables
 * ---------------------
 * @var   int     $id
 * @var   JForm   $form
 * @var   string  $fileClear
 * @var   string  $formClass
 * @var   string  $controlFields
 * @var   bool    $enctype
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
   	<head>
   	 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   	 	<title>Email von www.dautphetal.de</title>
   	 	<style type="text/css">
    		body {
    			margin: 0; 
    			padding: 0; 
    			min-width: 100%!important;
				font-family:Helvetica;
				font-size:15px;
				line-height:150%;
				text-align:  left;
    		}
    		.content {width: 100%; max-width: 600px;}

    		table { padding: 10px; margin: 0px; } 
    		table tr {}
    		table td {
				padding: 5px 0px;
				vertical-align: top;
    		}
    		table th { vertical-align: top; }
    		.bodycontainer {
    			color:#606060;
				font-family:Helvetica;
				font-size:15px;
				line-height:150%;
				text-align:left;
			}
			.bg-white { background-color: #FFFFFF; }
			.form-header { 
				font-size: 24px; 
				line-height: 150%;
				color: #4267b2;
				font-weight: 500;
				margin-left: 10px;
			}

			h4 { 
				font-size: 18px;
				line-height: 100%;
				font-weight: 500;
				margin-left: 10px;
				margin-right: 10px;
				margin-bottom: 5px;
				padding:10px;
				display: block;
				background-color: #999999;
				color:#FFFFFF;
			}
			.footer { 
				border-top: solid 1px #DDDDDD; 
				margin-top: 30px;
			}

    	</style>
    </head>
    <body yahoo class="bodycontainer" bgcolor="#E5E5E5">
    	
	
	<table width="100%" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>

			<?php

			$form->setAttribute('fileTimeOut', '');
			$fieldsets = $form->getXML();
			$formheader = $form->getValue((string)'headline'); 
			?>
			
			<?php 
			foreach ($fieldsets->fieldset as $fieldset)
			{
				if (!empty($fieldset['name']) && (string) $fieldset['name'] == 'submit')
				{
					continue;
				}

				$fieldsetLabel = (string) $fieldset['label'];

				if (count($fieldset->field)) : ?>
					<?php if (!empty($fieldsetLabel) && strlen($legend = trim(JText::_($fieldsetLabel)))) : ?>
						<h2><?php echo $legend; ?></h2>
					<?php endif; ?>

					
			    	<table class="content" bgcolor="#FFFFFF" align="center" border="0" cellpadding="0" cellspacing="0">
			            <tbody>
			            	
						<?php foreach ($fieldset->field as $field) :
							$label = trim(JText::_((string) $field['label']));
							$value = $form->getValue((string) $field['name']);
							$type = (string) $field['type'];
							$fileTimeOut = '';

							if (!empty($field['notmail']))
							{
								continue;
							}

							if ($type == 'note')
							{
								$value = trim(JText::_((string) $field['description']));
							}

							if ($type == 'file' && $fileClear > 0)
							{
								$fileTimeOut .= '<tr><td colspan="2">';
								$fileTimeOut .= JText::sprintf('JTF_FILE_TIMEOUT', $fileClear);
								$fileTimeOut .= '</td></tr>';
							}

							if ($type == 'spacer')
							{
								$label = '&nbsp;';
								$value = trim(JText::_((string) $field['label']));
							}

							if (empty($value))
							{
								// Comment out 'continue', if you want to submit only filled fields
								// continue;
							}



							$sublayoutValues = array(
								'form'          => $form,
								'value'         => $value,
								'type'          => $type,
								'fieldName'     => (string) $field['name'],
								'fieldMultiple' => filter_var($field['multiple'], FILTER_VALIDATE_BOOLEAN),
								'fileClear'     => $fileClear,
								'fileTimeOut'   => $fileTimeOut,
							);
							?>
							<tr>
								<th style="width:30%; text-align: left;">
									<?php echo strip_tags($label); ?>
								</th>
								<td>
									<?php if ($type == 'subform')
									{
										echo $this->sublayout('subform', $sublayoutValues);
									}
									else
									{
										echo $this->sublayout('mainform', $sublayoutValues);
									} ?>
								</td>
							</tr>
						<?php endforeach; ?>
						<?php if (empty($fileTimeOut))
						{
							$fileTimeOut = $form->getAttribute('fileTimeOut', '');
						}

						echo $fileTimeOut; ?>
						
						</tbody>
					</table>
				<?php endif;
			}?>

   		 </td>
	 	</tr>
		<tr>
			<td colspan="2" class="footer">					
	       
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top: 30px; margin-bottom: 30px;">
						<tr>
							
							<td><?php echo JText::_(EMAIL_SIGNATUR); ?></td>
						</tr>
				</table>
				
			</td>

		</tr> 	
</table>
</body>
</html>