<?php 
$url  = base_path().'/public/json/adminmodules.json';
$data1 = Session::get('data');
$menuitems = explode(',', $data1->module_list);
$data = file_get_contents($url);
$data = json_decode($data,true);
$menulist = array();
foreach ($menuitems as $key => $items){
  foreach ($data  as $key1=> $value){
    if($items == $key1)
    {$menulist[] = $value;}
 }
} 
?>
 <script type="text/javascript">
  function subMenuItems(id, val){  
     document.getElementById(id).innerHTML = val;  
  }
</script>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
         <li class="active" id="home">
          <a href="<?php echo url('/'.'home') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
         </li>
       <?php
            foreach($menulist as $k=>$v){
             if(!isset($menulist[$k]['child'])){
        ?>
        <li id=<?php echo "'main_".$k."'"; ?>>
          <a href="<?php echo url('/'.$v['url']) ?>" onclick="clickMenu(this);">
            <img src="<?php echo url('/public/images/'.$v['image_name']);?>" />&nbsp;&nbsp; <span><?php echo $v['name'];?></span>            
          </a>
        </li>
        <?php
           }else{
        ?>
        <li class="treeview" id=<?php echo "'main_".$k."'"; ?>>
          <a href="" onclick="clickMenu(this);">
             <i class="fa fa-files-o"></i>
               <span><?php echo $v['name'];?></span>
                <span class="pull-right-container">
                     <span id="sbnum_<?php echo $k; ?>" class="label label-primary pull-right"><?php //echo $nav['submenu_num']; ?></span>
                   </span>            
          </a>
          <ul class="treeview-menu">
          <?php
          $subnum=0; 
            foreach($menulist[$k]['child'] as $k1=>$v1):
              if(in_array($k1, $menuitems)){
          ?>            
            <li id=<?php echo "'main_".$k."_".$k1."'"; ?>>
            <a href="<?php echo url('/'.$v1['url']) ?>" onclick="clickMenu(this);">
            <i class="fa fa-circle-o"></i> <?php echo $v1['name'];?></a>
            </li>
           <?php
            $subnum++;
          }
          endforeach; ?>
                  <script>subMenuItems('sbnum_<?php echo $k; ?>', '<?php echo $subnum;?>')</script>
          </ul>
        </li>
       <?php }} ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <script type="text/javascript">
    function clickMenu(object){        
        localStorage.setItem("selected_node", $(object).parent().attr('id'));
    }
    
    /*This is only work on logout and home logo*/
    function removeMenu(){
        localStorage.removeItem("selected_node");
    }
   
    if(localStorage.getItem("selected_node") == null || localStorage.getItem("selected_node") == 'main_0'){
       $('#main_0').addClass('active');
    }
    else
    {
       $('#'+localStorage.getItem("selected_node")).addClass('active');
       if($('#'+localStorage.getItem("selected_node")).parent().attr('class') == 'treeview-menu'){
           $('#'+localStorage.getItem("selected_node")).parent().parent().addClass('menu-open');
           $('#'+localStorage.getItem("selected_node")).parent().css('display','block');
       }
    }
</script>
