<?php
	ldDisablePostProcessing();
	$ARCurrent->nolangcheck=true;
	if (!$this->validateFormSecret()) {
		error($ARnls['ariadne:err:invalidsession']);      
		exit;
	}
	if ($this->CheckLogin("layout") && $this->CheckConfig()) {
		echo "<pre>";
		set_time_limit(0);
		$this->find($this->path, '', "system.svn.commit.php", $arCallArgs, 0, 0);
		echo "</pre>";
		$this->call("window.opener.objectadded.js");
	}
?>
