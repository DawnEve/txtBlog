<?php
/**=============================================
 * SearchController Class
 *
 * 内容搜索类
 * 类名时驼峰法，方法名是下划线法。
 *
 * @version		v3.1.0
 * @revise		2023.04.26
 * @date		2023.04.26
 * @author		Dawn
 * @email		JimmyMall@live.com
 * @link		https://github.com/dawneve/txtBlog
 =============================================*/
class SearchController extends Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index($keyword=''){
		if($keyword=='')return;
	
		/*
		搜索流程：
			1.加载2个函数
				函数1 对每个文件正则匹配。
				函数2 根据顶部目录-左侧目录遍历 data/下的文件，调用函数2
			2.加载视图，在其中调用函数，输出有匹配行的文件的路径，标题与链接
				使用框架的 data/ 目录绝对地址常量
		牵涉文件：一个控制器，一个视图文件。
		*/
		
		//加载视图并显示
		$c = substr(__class__,0,stripos(__class__,'Controller'));
		$a = substr(__method__,2+stripos(__method__,'::'));

		$file=$c.'/'.$a;
		include('View/'.$file.'.html');
	}
	

	//测试结果
	// http://blog.dawneve.cc/index.php?c=search&a=some
	public function some($id){
		echo __class__;
		echo '<hr>';
		echo $id;
	}



	/*
	 * Function I: get matched lines for a given file
	 **/
	// 逐行读取一个文件，匹配的行打印出来，并高亮关键词
	private function printAndHighlight($filename, $keyword, $data_base_path){
		//$filename="html\http.txt";
		$abs_filename=$data_base_path . $filename;
		$i2=0;
		$result="<pre>";
		if( file_exists($abs_filename) ){
			$handler=fopen($abs_filename, "r");
			while(!feof($handler)){
				$i2++;
				$buffer=fgets($handler);
				$regExp="/(".$keyword.")/i";
				if(preg_match($regExp, $buffer, $matches)){
					$res='<span style="color:red">\1</span>';
					$text=preg_replace($regExp, $res, htmlentities($buffer));
					$result .= "<span style='color:#B13E8D99;'>".$filename. "</span>".
						"<span style='color:green'>:" . $i2 . ": </span>" . $text;
				}
			}
			fclose($handler);
			$result .="</pre>";
		}
		return $result;
	}



	/*
	 * Function II: get file path and its url
	 **/
	private function iterator_files($keyword, $data_base_path){
		$topMenu=include( $data_base_path . "TopMemu.php");
		//print_r($topMenu);

		//遍历输出每个左侧目录的文件名
		$i=0;
		$base_url="/index.php";
		foreach($topMenu as $key => $value){
			$i++;
			//if($i>10) //调试控制
			//	break;

			//id1_id2 用于url中的id拼凑 http://blog.dawneve.cc/index.php?k=PHP&id=1_0#0
			$id1=-1;
			
			//获取左侧目录
			$leftMenu=include($data_base_path .$key . ".php");
			//遍历左侧目录：解析出文件名和url
			foreach($leftMenu as $items){
				$i++;
				$id1++;
				$id2=-1;
				foreach($items[2] as $item){
					$id2++;
					$url=$base_url."?k=".$key."&id=".$id1."_".$id2;
					$filename=$key . "\\" . $item[1] ."." . $item[2];
					$anchor= "<a target='_blank' href='".$url."'>" . $filename . " >> " . $item[0]."</a>";
					
					if(file_exists($data_base_path . $filename)){
						$result=self::printAndHighlight($filename, $keyword, $data_base_path);
						if($result != "<pre></pre>"){
							if($filename=="Bio\bio02.html"){
								echo "debug here>>>";
								print_r($result);
								echo "debug end<<<";
							}
							echo "<h3 class=itemHeader>".$anchor." </h3>";
							echo "<div class=box>" .$result. "</div>";
						}					
					}
				}
			}
		}
	}
	

}