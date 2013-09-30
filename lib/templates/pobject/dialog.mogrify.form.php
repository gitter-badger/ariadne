<?php
	$ARCurrent->nolangcheck=true;
	if ($this->CheckLogin("edit") && $this->CheckConfig()) {
            
            if ($this->getvar('targets')) {
			$targets = $this->getvar("targets");
		} else {
			   $targets = array($this->path);
		}
?>
<fieldset id="data" class="mogrify">
	<legend><?php echo $ARnls["ariadne:mogrify"]; ?></legend>
            <?php
                foreach ($targets as $target) {
                    $targetob = current($this->get($target, "system.get.phtml"));
                    $type = $this->getvar("type");

                    if (!$type) {
                        $type = $targetob->type;
                    }
                    $icon = $ARCurrent->arTypeIcons[$targetob->type]['medium'] ? $ARCurrent->arTypeIcons[$targetob->type]['medium'] : $targetob->call("system.get.icon.php", array('size' => 'medium'));
                    $iconalt = $targetob->type;
                    if ( $targetob->implements("pshortcut") ) {
                        $overlay_icon = $icon;
                        $overlay_alt = $targetob->type;
                        if ( $ARCurrent->arTypeIcons[$targetob->vtype]['medium'] ) {
                            $icon = $ARCurrent->arTypeIcons[$targetob->vtype]['medium'];
                        } else {
                            $icon = current($targetob->get($targetob->data->path, "system.get.icon.php", array('size' => 'medium')));
                        }
                    }
            ?>
            <div class="field">
                <?php
                    echo '<img src="' . $icon . '" alt="' . htmlspecialchars($iconalt) . '" title="' . htmlspecialchars($iconalt) . '" class="typeicon">';
                        if ( $overlay_icon ) {
                            echo '<img src="' . $overlay_icon . '" alt="' . htmlspecialchars($overlay_alt) . '" title="' . htmlspecialchars($overlay_alt) . '" class="overlay_typeicon">';
                        }
                    echo '<div class="name">' . $targetob->nlsdata->name . ' ';
                    echo "( " . $ARCurrent->arTypeNames[$targetob->type] . " / " . $targetob->type . " )";
                    echo '</div>';
                    echo '<div class="path">' . $target . '</div><br>';
                }
                ?>
            <label for="target" class="required" style="float: left; width: 65px; margin-top: 5px;"><?php echo $ARnls["ariadne:type"]; ?></label>
            <select class="selectline" name="type">
            <?php
                foreach ( $ARCurrent->arTypeNames as $typeValue => $typeName ) {
                    echo '<option value="'.$typeValue.'"';
                    if ($typeValue==$type) {
                        echo ' selected';
                    }
                    echo '>'.$typeName.' ( '.$typeValue.' ) </option>'."\n";
                }
            ?>
            </select>
        </div>
</fieldset>
<?php	} 
?>