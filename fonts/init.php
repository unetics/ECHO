<?php
switch (tr_option_field("[fonts]")) {
	case 1:
    	get_template_part( 'fonts/1' );      
	break;
	case 2:
		get_template_part( 'fonts/2' );
	break;			
    
    default:
    	get_template_part( 'fonts/1' ); 
	break;
}       