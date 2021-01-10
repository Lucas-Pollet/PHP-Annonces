<?php
/* Smarty version 3.1.34-dev-7, created on 2021-01-09 19:00:48
  from 'D:\wamp64\www\app\Views\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ffa51c0ceb9c7_68863580',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '511d49a3649faee7a23d4aeb53fec7785c12e9a5' => 
    array (
      0 => 'D:\\wamp64\\www\\app\\Views\\header.tpl',
      1 => 1610238112,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ffa51c0ceb9c7_68863580 (Smarty_Internal_Template $_smarty_tpl) {
?><head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo base_url();?>
/public/css/knacss.css">
    <link rel="stylesheet" href="<?php echo base_url();?>
/public/css/mystyle.css">
    <link rel="stylesheet" href="<?php echo base_url();?>
/public/css/card.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
</head>

<h1 class="title-site">Annonces immobilières</h1>
<div class="autogrid">
    <a href="<?php echo base_url();?>
/public/" class="bar"><div class="button-bar">Acceuil</div></a>
    <a href="<?php echo base_url();?>
/public/page" class="bar"><div class="button-bar">Liste Annonces</div></a>
    <a href="<?php echo base_url();?>
/public/inscription" class="bar"><div class="button-bar"><i class="fas fa-user-plus"></i> Inscription</div></a>
    <a href="<?php echo base_url();?>
/public/connexion" class="bar"><div class="button-bar"><i class="fas fa-lock"></i> Connexion</div></a>
</div>
<?php }
}
