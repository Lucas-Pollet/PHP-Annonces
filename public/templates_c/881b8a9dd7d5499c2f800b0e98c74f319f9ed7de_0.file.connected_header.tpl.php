<?php
/* Smarty version 3.1.34-dev-7, created on 2021-01-10 11:55:45
  from 'D:\wamp64\www\app\Views\connected_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ffb3fa1a7a359_54905327',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '881b8a9dd7d5499c2f800b0e98c74f319f9ed7de' => 
    array (
      0 => 'D:\\wamp64\\www\\app\\Views\\connected_header.tpl',
      1 => 1610238340,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ffb3fa1a7a359_54905327 (Smarty_Internal_Template $_smarty_tpl) {
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
/public/account" class="bar"><div class="button-bar"><i class="fas fa-user-alt"></i> Profil</div></a>
    <a href="<?php echo base_url();?>
/public/logout" class="bar"><div class="button-bar"><i class="fas fa-sign-out-alt"></i> Se déconnecter</div></a>
</div>
<?php }
}
