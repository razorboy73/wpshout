<div class="ghc-shortcode">

<?php
    foreach($contributors as $user){
        include "shortcode-user.php";
    }

    ?>
</div>



function dbtHTML(){ ?>

//         <div class="wrap">
//             <div class="row oxd-admin-row">
//                 <h1><?php _e('Debate Plugin','dbt'); ?></h1>
//                     <p><?php _e('This debate plugin is an easy and simple plugin to create debates on your website in four steps:','dbt'); ?></p>
//                         <ol>
//                             <li><?php _e('Create a debate and give a starting date and closing date.','dbt'); ?></li>
//                             <li><?php _e('Create two proposals','dbt'); ?></li>
//                             <li><?php _e('Go to Debate, link the proposals to the debate and publish it.','dbt'); ?></li>
//                         </ol>
//                     </div>
//             </div>    
//          <div class="wrap">
//             <h1>Debate Settings</h1>
//             <form action="options.php" method="POST" >
//             <?php
//             settings_fields("lmtplugin");
//             do_settings_sections("dbt-settings-page");
//             //submit_button();
//            ?>
//             </form>
//             <div class="row oxd-admin-row">
//             <h3><?php _e('Shortcode options','oxd'); ?></h3>
//             <table class="form-table">
//                 <tr valign="top">
//                     <td scope="row">
//                         <p><strong><?php _e('Basic shortcode','oxd'); ?></strong></p>
//                         <blockquote>[debates_q]</blockquote>
//                     </td>
//                 </tr>
//                 <tr valign="top">
//                     <td scope="row">
//                         <p><strong><?php _e('Open debates shortcode','oxd'); ?></strong></p>
//                         <p><?php _e('It lists only the open debates on your page.','oxd'); ?></p>
//                         <blockquote>[debates_q type="open"]</blockquote>
//                     </td>
//                 </tr>
//                 <tr valign="top">
//                     <td scope="row">
//                         <p><strong><?php _e('Closed debates shortcode','oxd'); ?></strong></p>
//                         <p><?php _e('It lists only the closed debates on your page.','oxd'); ?></p>
//                         <blockquote>[debates_q type="closed"]</blockquote>
//                     </td>
//                 </tr>
//                 <tr valign="top">
//                     <td scope="row">
//                         <p><strong><?php _e('Coming soon debates shortcode','oxd'); ?></strong></p>
//                         <p><?php _e('It lists only the debates that are coming soon.','oxd'); ?></p>
//                         <blockquote>[debates_q type="soon"]</blockquote>
//                     </td>
//                 </tr>
//                 <tr valign="top">
//                     <td scope="row">
//                         <p><strong><?php _e('Number of listed debates','oxd'); ?></strong></p>
//                         <blockquote>[debates_q type="x"]</blockquote>
//                     </td>
//                 </tr>
//             </table>
//             </div>
//         </div>
//         <?php }