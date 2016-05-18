<?// функция трассировки
global $dumpCnt;
$dumpCnt = 0;

//собираем все массивы для дампа
if (!function_exists("dump")) {
	function dump($var, $name = "", $drawAsPHPArray = false, $htmlSpecialChars = true) {
	    global $dumpCnt;
	    $id = date("i_s_");
	    $id .= $dumpCnt;
	    $scriptname = $_SERVER["REAL_FILE_PATH"] ? $_SERVER["REAL_FILE_PATH"] : $_SERVER["SCRIPT_FILENAME"];
	    if (is_array($var) && $drawAsPHPArray)
	        $body = drawArray($var);
	    elseif ($var === true)
	        $body = "true";
	    elseif ($var === false)
	        $body = "false";
	    elseif (is_string($var) || is_int($var))
	        $body = $var;
	    else {
	        ob_start();
	        print_r($var);
	        $body = ob_get_clean();
	    }
	    $body = str_replace("\n", "\\n", $body);
	    $body = str_replace("\r", "\\n", $body);
	    $body = str_replace("\"", "\\\"", $body);
	    if ($htmlSpecialChars)
	        $body = htmlspecialchars($body);
	    $style = '#dd_develope_overlay {
	        width: 100%;
	        height: 100%;
	        min-height: 100px;
	        position: fixed;
	        background: rgba(0,0,0,.5) repeating-linear-gradient( -45deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2) 10px, transparent 10px, transparent 20px );
	        top: 0;
	        left: 0;
	        z-index: 99999;
	        cursor: pointer;
	    }
	    #dd_dump_area {
	        width: 1000px;
	        height: 95%;
	        position: fixed;
	        background: #eee;
	        color: #111;
	        top: 2.5%;
	        border-radius: 16px;
	        z-index: 100000;
	        left: 50%;
	        margin-left: -500px;
	        box-shadow: 0 0 10px rgba(0,0,0,.7);
	        overflow: hidden;
	        font-family: arial, sans-serif;
	        font-size: 15px;
	        text-transform: none;
	        box-sizing: content-box;
	    }
	    #dd_dump_area * {
	        box-sizing: content-box;
	    }
	    .dd_title {
	        width: 100%;
	        height: 30px;
	        background: #3f3f3f;
	        color: #ddd;
	        font-weight: bold;
	        border: none;
	        box-shadow: 0 0 10px rgba(0,0,0,.6);
	        position: relative;
	        z-index: 100002;
	    }
	    .dd_title span {
	        padding: 7px 10px 3px;
	        display: block;
	    }
	    #dd_dump_list {
	        width: 200px;
	        height: 100%;
	        float: left;
	    }
	    #dd_dump_list ul {
	        list-style: none;
	        margin: 0;
	        padding: 0;
	        overflow-y: auto;
	        position: relative;
	        z-index: 100001;
	    }
	    #dd_dump_list li {
	        width: 180px;
	        min-height: 20px;
	        border-top: 1px solid #999;
	        padding: 7px 10px 3px;
	        display: block;
	        color: inherit;
	        text-decoration: none;
	        cursor: pointer;
	        transition: all 0.2s ease 0s;
	    }
	    #dd_dump_list li:first-child {
	        border: none;
	    }
	    #dd_dump_list li:hover {
	        background: #ddd;
	    }
	    #dd_dump_list li.dd_active {
	        background: #333;
	        color: #ddd;
	        cursor: default;
	    }
	    #dd_dump_list li.dd_active:hover {
	        background: #333;
	    }


	    #dd_dump_detail {
	        width: 799px;
	        border-left: 1px solid #999;
	        height: 100%;
	        float: right;
	    }
	    #dd_dump_detail pre {
	        margin: 0 0 30px 0;
	        padding: 15px 20px;
	        overflow: auto;
	        font-size: inherit;
	        font-family: inherit;
	        width: 759px;
	        display: none;
	        vertical-align: top;
	    }

	    #dd_dump_button {
	        font-size: 15px;
	        min-width: 15px;
	        height: 15px;
	        padding: 5px;
	        background: #333;
	        position: fixed;
	        right: 0;
	        bottom: 0;
	        display: block;
	        color: #69f;
	        text-align: center;
	        z-index: 99998;
	        box-shadow: 0px 0px 3px rgba(0,0,0,.7);
	        cursor: pointer;
	        border-top-left-radius: 5px;
	        box-sizing: content-box;
	    }
	    #dd_dump_button:hover {
	        background: #383838;
	    }';
	    $style = str_replace("\n", "\\n", $style);
	    $style = str_replace("\"", "\\\"", $style);
	    ?>
	    <script type="text/javascript">
	        <?if ($dumpCnt == 0):?>
	            if (document.getElementById("dd_dump_area") == null) {
	                function dd_close_dump () {
	                    document.getElementById("dd_develope_overlay").style.display = "none";
	                    document.getElementById("dd_dump_area").style.display = "none";
	                    return false;
	                }
	                function dd_open_dump () {
	                    document.getElementById("dd_develope_overlay").style.display = "block";
	                    document.getElementById("dd_dump_area").style.display = "block";
	                    return false;
	                }
	                function dd_show_pre (element) {
	                    console.log(element);
	                    var dumps = Array.prototype.slice.call(document.getElementById("dd_dump_detail").getElementsByTagName("pre")),
	                        buts  = Array.prototype.slice.call(document.getElementById("dd_dump_list").getElementsByTagName("li"));

	                    dumps.forEach(function(pre){
	                        pre.style.display = "none";
	                    });
	                    buts.forEach(function(li){
	                        li.removeAttribute("class");
	                    });

	                    element.setAttribute("class", "dd_active");
	                    var pre = document.getElementById(element.getAttribute("dumpid"));
	                    pre.style.display = "block";
	                    pre.focus();
	                    document.getElementById("dd_title_text").innerHTML = element.innerHTML + " (" + element.getAttribute("scriptname") + ")";
	                    return false;
	                }
	                function onWindowResize () {
	                    var dumps = Array.prototype.slice.call(document.getElementById("dd_dump_detail").getElementsByTagName("pre")),
	                        list  = document.getElementById("dd_dump_list").getElementsByTagName("ul")[0];

	                    dumps.forEach(function(pre){
	                        pre.style.height = document.getElementById("dd_dump_detail").offsetHeight - 60 + "px";
	                    });
	                    list.style.height = document.getElementById("dd_dump_list").offsetHeight - 30 + "px";
	                }
	                window.addEventListener("resize", onWindowResize);

	                var ddOverlay  = document.createElement("div"),
	                    ddArea     = document.createElement("div"),
	                    ddDumpList = document.createElement("div"),
	                    ddDumps    = document.createElement("div"),
	                    ddButton   = document.createElement("div"),
	                    ddUl       = document.createElement("ul");
	                    ddStyle    = document.createElement("style");


	                if (document.body == null)
	                    document.body = document.createElement("body");

	                document.head.appendChild(ddStyle);
	                document.body.appendChild(ddOverlay);
	                document.body.appendChild(ddArea);
	                document.body.appendChild(ddButton);
	                document.body.appendChild(ddButton);
	                ddArea.appendChild(ddDumpList);
	                ddArea.appendChild(ddDumps);
	                ddDumpList.innerHTML = '<div class="dd_title"><span>Все дампы</span></div>';
	                ddDumpList.appendChild(ddUl);
	                ddDumps.innerHTML = '<div class="dd_title"><span id="dd_title_text"><?=$name != "" ? $name : "DUMP #0"?> (<?=$_SERVER["REAL_FILE_PATH"] ? $_SERVER["REAL_FILE_PATH"] : $_SERVER["SCRIPT_FILENAME"]?>)</span></div>';
	                ddStyle.innerHTML = "<?=$style?>";
	                ddStyle.setAttribute("type", "text/css");
	                ddOverlay.setAttribute("id", "dd_develope_overlay");
	                ddArea.setAttribute("id", "dd_dump_area");
	                ddDumpList.setAttribute("id", "dd_dump_list");
	                ddDumps.setAttribute("id", "dd_dump_detail");
	                ddButton.setAttribute("id", "dd_dump_button");

	                ddOverlay.addEventListener("click", dd_close_dump);
	                ddButton.addEventListener("click", dd_open_dump);
	            }
	        <?endif;?>

	        var ddCount = Array.prototype.slice.call(ddUl.getElementsByTagName("li")).length,
	            ddListItem = document.createElement("li");
	        ddListItem.setAttribute("onclick", "dd_show_pre(this)");
	        ddUl.appendChild(ddListItem);
	        ddListItem.setAttribute("scriptname", "<?=$scriptname?>");
	        ddListItem.setAttribute("dumpid", "dd_dump_<?=$id?>");
	        ddListItem.innerHTML = '<?=$name == "" ? "DUMP #'+ddCount+'" : $name?>';

	        var ddDump = document.createElement("pre");
	        ddDumps.appendChild(ddDump);
	        ddDump.innerHTML = "<?=$body?>";
	        ddDump.setAttribute("id", "dd_dump_<?=$id?>");

	        if (ddCount == 0) {
	            ddListItem.setAttribute("class", "dd_active");
	            ddDump.style.display = "block";
	        }
	        ddButton.innerHTML = (ddCount + 1) + " dump" + (ddCount != 0 ? "s" : "");

	        onWindowResize();
	    </script>
	    <?$dumpCnt++;
	}
}
//функция отрисовки массива по стандартам php
if (!function_exists("drawArray")) {
	function drawArray($array, $lvl = 0, $txt = "", $wrapping = false) {
		if (!is_array($array))
			return "Ошибка! первым параметром функции drawArray() должен являться массив.\n";
		if ($wrapping && $lvl == 0)
			$txt .= "<pre>";
		$txt .= "array (\n";
		$margin = "";
		for ($i = 0; $i < $lvl; $i++)
			$margin .= "\t";
		foreach($array as $key => $value) {
			if (is_string($key)) {
				$txt .= $margin . "\t\"" . $key . "\" => ";
			}
			else {
				$txt .= $margin . "\t" . $key . " => ";
			}
			if (is_array($value)) {
				$lvl++;
				$txt = drawArray($value, $lvl, $txt);
				$lvl--;
			}
			else {
				if (empty($value) || is_string($value))
					$value = "\"" . htmlspecialchars(str_replace("\"", "\\\"", str_replace("\\", "\\\\", $value))) . "\"";
				elseif ($value === true)
					$value = "true";
				elseif ($value === false)
					$value = "false";
				$txt .= $value . ",\n";
			}
		}
		$txt = mb_substr($txt, 0, mb_strlen($txt) - 2) . "\n" . $margin . ")" . ($lvl != 0 ? "," : "") . "\n";

		if ($wrapping && $lvl == 0)
			$txt .= "</pre>";
		return $txt;
	}
}