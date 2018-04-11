<?php /* Smarty version 2.6.20, created on 2018-04-06 15:21:43
         compiled from index_cache.tpl */ ?>
 <div id="rightcontent">
    <div id="errorbox" style="display: none;"></div>
    <div id="messagebox" style="display: none;"></div>

    <div id="right">
        <div align="center">
            <h2>缓存清空</h2>
            <table width="80%" cellspacing="5" cellpadding="5" border="0">
            <tr class="view">
                <td align="center">
                    <a href="/siteadmin/index.php?m=cache&act=frontend">
                        <b>清空前台缓存</b>
                    </a>
                </td>
                <td align="center">
                    <a href="/siteadmin/index.php?m=cache&act=backend">
                        <b>清空后台缓存</b>
                    </a>
                </td>
                <td align="center">
                    <a href="/siteadmin/index.php?m=cache&act=index">
                        <b>清空公共缓存</b>
                    </a>
                </td>
            </tr>
            </table>
        </div>
    </div>
    <br>
    <div id="right">
        <div id="static_content">
            <?php if ($this->_tpl_vars['msg']): ?> <?php echo $this->_tpl_vars['msg']; ?>
 <?php endif; ?>
            <?php if ($this->_tpl_vars['num'] > 0): ?> <?php echo $this->_tpl_vars['num']; ?>
个缓存文件被清空<?php endif; ?>
        </div>
    </div>
 </div>