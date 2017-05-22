<?php
define("INNER_ACCESS","1");
include_once("header.php");
include_once("config.php");
?>
	<div id="content">
		<div id="about_content">
			<div><b>About</b></div>
			<div>SeuTube is a SRTP project of Southeast University. All related web pages, background programs or scripts and all documents of this website are distributed under
			<a href="<?php echo $host_name;?>/license"><u>GNU General Public License v3</u></a>. Please read carefully before using it.
			</div>
			<div><b>Project</b></div>
			<div><a href="http://code.google.com/p/seutube/">http://code.google.com/p/seutube/</a></div>
		</div>
		<div id="about_content">
			<div><b>Programming</b>
				<div><a href="about/crisp">Crisp</a>, <a href="about/bh">Bhuitaijiu</a>, <a href="about/aaron">Aaron</a></div>
			</div>
			<div><b>Artworks</b>
				<div><a href="about/lzb">Li Zhongbo</a>, Crazybunny</div>
			</div>
			<div><b>Test</b>
				<div>Napoleon, No.1412, Louis, Shiderbi, zt, mayao, suiigo, rongzheyi, DBAyM, venture, HC</div>
				<div>Shevacjs, ×¢Ë®Öí, James, Essie</div>
			</div>
		</div>
		<div id="about_content">
			<div><b>Statistics</b></div>
			<div>Registered user: 
			<?php
			$sql="select count(*) from st_user";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$regn=$row['count(*)'];
			echo $regn;
			?>
			</div>
			<div>Movies: 
			<?php
			$sql="select count(*) from st_movie";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$movn=$row['count(*)'];
			echo $movn;
			?>
			</div>

		</div>
	</div>
<?php
include("footer.php");
?>
