<form onsubmit="presubmit();" action="<?PHP echo $lang; ?>/main/postdata" method="POST" id="login" >
    <fieldset id="inputs">
        <input type="text" name="name" value="" placeholder="<?PHP echo $this->_('review_name'); ?>" autofocus required />
        <input type="text" name="email" value="" placeholder="<?PHP echo $this->_('review_email'); ?>" required />
    </fieldset>
    <textarea name="content" id="editor"></textarea>
    <fieldset id="actions">
        <div style="float: left;">
            <input type="submit" id="submit" value="<?PHP echo $this->_('review_save'); ?>">
        </div>
        <div style="float: left; margin-left: 20px;">
            <input type="button" id="submit" class="preview" value="<?PHP echo $this->_('review_view'); ?>">
        </div>
    </fieldset>
    <style>
        #buffer {
            display: none;
            background-color: white;
            height: 500px;
        }
        
        #buffershow {
            display: none;
        }
        
        div.mf {
            float: left;
            clear: both;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
        } 
    </style>
    <a id="buffershow" href="#buffer" rel="inline-800-500"  class="pirobox_gall1">Inline content</a>
 
<!-- hidden div to call-->
<div id="buffer">
    <div class="mf"></div>
</div>
<!-- end hidden div-->
<?PHP //echo $_SESSION['userid']; ?>
</form>