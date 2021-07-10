<?php
   // Always include IF ELSE clause for accomdate save_action 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       update_post_meta($post_id,'sidebar-small-title',$_POST['sidebar_small_title']);
    }
    else{
        
     $template = get_post_meta( $meta_id->ID, 'template', true );
    ?>
    
    <table class="form-table">
         <tbody>
          <tr scope="row">
			<th style="width:33%;">
			  <label for="rrrr">  <?php echo esc_html__('Restriction Execution Method', 'rimplenet'); ?>
			   <span class="dashicons dashicons-editor-help" title="How the rules will be checked if it's meet requirement before access to the content is allowed"></span>
              </label>
			</th>
			<td>
			    <select id="rrrr" name="rimplenet_template_restriction_access_rule[_um_accessible]" style="width:100%;">
			    <option value="" selected="selected"> <?php echo esc_html__('Do not Restrict Content', 'rimplenet'); ?> </option>
			    <option value="sequential"> <?php echo esc_html__('Sequential ~ sequential will allow rules to be executed one after the other', 'rimplenet'); ?> </option>
			    <option value="logical"> <?php echo esc_html__('Logical (using AND/OR) ~ all rules are evealuated at the same time', 'rimplenet'); ?>  </option>
			    </select>
			</td>
		 </tr>
		</tbody>	
	  </table>
	  <div id="rn_rules_settings">
	      <table class="form-table">
             <tbody>
              <tr scope="row">
    			<th style="width:16%;">
    			    <?php echo esc_html__('CURRENT USER META', 'rimplenet'); ?>
    			   <span class="dashicons dashicons-editor-help" title="How the rules will be checked if it's meet requirement before access to the content is allowed"></span>
                
    			</th>
    			<td style="width:20%;">
    			    <input  type="text" id="currentuser_metakey" name="currentuser_metakey" placeholder="usermeta_key here" style="width:100%;">
    			</td>
    			<td style="width:15%;">
    			    <select id="rrrr" name="rimplenet_template_restriction_access_rule[_um_accessible]" style="width:100%;">
    			    <option value="" selected> Select Condition </option>
    			    <option value=""> = </option>
    			    <option value="logical"> !=  </option>
    			    <option value="sequential"> > </option>
    			    <option value="logical"> <  </option>
    			    <option value="logical"> >=  </option>
    			    <option value="logical"> <=  </option>
    			    </select>
    			</td>
    			<td>
    			    <input  type="text" id="currentuser_metavalue" name="currentuser_metavalue" placeholder="usermeta_value here" style="width:100%;">
    			</td>
    		 </tr>
    		</tbody>	
	   </table>
	      
	  </div>
	  <div style="float:right;">
	    <p style="max-width:600px; display:inline;">
	     <select id="rrrr" name="rimplenet_template_restriction_access_rule[_um_accessible]">
			    <option value="" selected="selected"> <?php echo esc_html__('Select Rule to Add', 'rimplenet'); ?> </option>
			    <option value="rimplenet_current_user_meta_restriction_rules"> <?php echo esc_html__('Current User Meta Rules', 'rimplenet'); ?> </option>
			    <option value="logical"> <?php echo esc_html__('Logical (using AND/OR) ~ all rules are evealuated at the same time', 'rimplenet'); ?>  </option>
		 </select>
	     <a href="#" class="button button-primary button-large add-field">+ Add Field</a>
	    </p>
	  </div>
	  <div class="clear"></div>
	  <br>
	  
	  
      
  <?php
        
    }

  ?>