<style><?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/main.css'); ?></style>
<style><?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/material.css'); ?></style>
<style><?php if (@$_COOKIE["dark"] == "true") echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/mat_dark.css'); ?></style>
<style>
@media (prefers-color-scheme: dark) {
<?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/mat_dark.css'); ?>
p#darkmodep::after {
    content: 'System-wide dark mode enabled, so you cannot disable it from here.';
}
#darkmode {
	display: none;
}
}
</style>
