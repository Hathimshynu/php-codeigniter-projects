<?php include 'header.php'; ?>
<style>
    .demo_name_style_red {
        background-color: #dd574c;
        padding: 2px;
        border-radius: 2px;
        margin-top: 5px;
        margin-bottom: 0;
        color: #fff
    }

    .demo_name_style_blue {
        background-color: #40b6e4;
        padding: 2px;
        border-radius: 2px;
        margin-top: 5px;
        margin-bottom: 0;
        color: #fff
    }

    .jOrgChart td {
        text-align: center;
        vertical-align: top;
        padding: 0
    }

    .jOrgChart .node {
        font-size: 12px !important;
        color: #428bca;
        display: inline-block;
        width: auto;
        margin: -5px 25px;
        z-index: 10;
        overflow: hidden;
        word-break: break-all
    }

    .jOrgChart .down {
        background-color: #c8d5d8;
        margin: 0 auto
    }

    .jOrgChart .username {
        overflow: hidden;
        width: auto;
        color: #FFF;
        background: #807979;
        padding: 2px 8px;
        border-radius: 2px
    }

    .jOrgChart .right {
        border-left: 2px solid #fff
    }

    .jOrgChart .top {
        border-top: 2px solid #c8d5d8
    }

    .jOrgChart td {
        text-align: center;
        vertical-align: top;
        padding: 0
    }

    .jOrgChart .right {
        border-left: 2px solid #fff
    }

    .jOrgChart .line {
        height: 24px;
        width: 2px
    }

    .jOrgChart td {
        text-align: center;
        vertical-align: top;
        padding: 0
    }

    .jOrgChart .left {
        border-right: 2px solid #c8d5d8
    }

    .orgChart {
        overflow: auto;
        margin-top: 30px;
        transform-origin: 0 0 0 !important
    }

    .jOrgChart {
        margin-top: 26px
    }

    .tooltipster-sidetip .tooltipster-content {
        padding: 0px;
    }

    .tree_img_tree {
        width: 100%;
    }

    .Demo_head_bg {
        padding: 10px 5px 3px 5px !important;
    }

    #bin {
        width: 185px !important;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    Binary Tree</h4>
            </div>
            <div class="card-body">
                <div id="tree" class="orgChart"
                    style="transform: matrix(1, 0, 0, 1, 0, 0); transform-origin: 50% 50% 0px;">

                    <div class="jOrgChart">
                        <table id="tree_div" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>
                                <div>
                                    <tr class="node-cells">
                                        <td class="node-cell" colspan="4">
                                            <div class="node">
                                                <i style="font-size: 35px" class="fa fa-user " aria-hidden="true"></i>
                                                <br>
                                                <div>
                                                    <p class="demo_name_style_red ">
                                                        <?= $rr ?>
                                                    </p>
                                    <tr>
                                        <td colspan="4">
                                            <div class="line down">
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                                <tr>
                                    <td class="node-container" colspan="1">
                                        <?php
                                        foreach ($aa as $key => $row) {
                                            ?>
                                            <table id="tree_div"  cellpadding="0" border="0" align="center">
                                                <tbody>
                                                    <div>
                                                        <div class="node">
                                                            <i style="font-size: 35px" class="fa fa-user "
                                                                aria-hidden="true"> <a
                                                                    href="<?= BASEURL ?>user/binarytree/<?= $row['user_id'] ?>"></i>
                                                            <br>
                                                            <p class="demo_name_style_blue add-btn">
                                                                <?= $row['user_id'] ?>
                                                            </p></a>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <div class="line down">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </div>
                                                    </div>
                                                </tbody>
                                            </table>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>

                                    <td class="line right">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        </td>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>