<? 

$app=$this->uri->segment(1, 0);

if (! $app) {

$app="red5";
}

 ?>


<ul class="ca-menu">
        <li>
                <a href="/<? echo $app; ?>">
                        <div class="ca-content">
                        <h2 class="ca-main">Status</h2>
                        <h3 class="ca-sub">ET Phone Home</h3>
                        </div>
                </a>
        </li>
	<li>
		<a href="/<? echo $app; ?>/display/active_clients/">
			<div class="ca-content">
			<h2 class="ca-main">Active Clients</h2>
			<h3 class="ca-sub">See Who Is Watching</h3>
			</div>
		</a>
	</li>
        <li>
                <a class="various" href="/<? echo $app; ?>/display/all_clients">
                        <div class="ca-content">
                        <h2 class="ca-main">All Clients</h2>
                        <h3 class="ca-sub">See All The Visitors</h3>
                        </div>
                </a>
        </li>
        <li>
                <a href="/<? echo $app; ?>/display/all_sessions">
                        <div class="ca-content">
                        <h2 class="ca-main">All Sessions</h2>
                        <h3 class="ca-sub">The Who, Where, & When</h3>
                        </div>
                </a>
        </li>
  <li>
                <a href="/<? echo $app; ?>/display/all_streams">
                        <div class="ca-content">
                        <h2 class="ca-main">All Streams</h2>
                        <h3 class="ca-sub">ALL of US</h3>
                        </div>
                </a>
        </li>


</ul>
