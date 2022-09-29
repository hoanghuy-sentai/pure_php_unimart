<?php
    function construct()
    {

    }

    function show_introduceAction()
    {
        load_model("page");
        load_model("cus_product");
        $id=(int)$_GET['id'];
        
        $page=get_page_by_id($id);
        $data['page']=$page;
        
        /*most saling */
        $rs=array();
        $mostSaling=get_most_saling();
        foreach($mostSaling as $item)
        {
            if($item['qty']>5)
            {
                $rs[]=$item;
            }
        }
        $data['mostSaling']=$rs;
        /**/

        load_view("ClientIntroduceShow_introduce",$data);
    }
?>