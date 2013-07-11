<?PHP
if (count($_GET)) {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $q = $url['query'] . "&";
    parse_str($url['query'], $query_index);
} else {
    $q = false;
}

?>
<style type="text/css">
    .detailcolumn {
        display: none;
    }
    
    th {
        cursor: pointer;
    }
</style>
<div class="container-fluid">
    <div class="row-fluid">
		<div class="span3">
		    <?PHP include("navigation.php"); ?>
		</div>
		<div class="span9">
		    <h1 class="pull-right">Greater Mysteries</h1>
		</div>
    </div>
    <div class="row-fluid">
	<div class="span12">

	    <?PHP
	    echo isset($page_title) ? $page_title : '';

	    if (isset($query_data)) {
		echo '<h3>Remove Filters:</h3> <ul class="unstyled">';
		foreach ($query_data as $name => $value) {
		    $query_copy = $query_data;
		    unset($query_copy[$name]);
		    $query = implode("&", $query_copy);
		    echo '<li><i class="icon-remove-sign"></i> <a href="/altar?' . $query . '"><q>' . $name . '</q></a></li>';
		}
		echo '</ul>
            <h3>Sacrifices</h3>   
            ';
	    }
	    ?>


	    <!--p>Click a row heading to sort the table, or a <i class="icon-search"></i> search link to search the table for that thing.
                <?PHP  if ($q) { ?>
                Click a <i class="icon-filter"></i> filter link to add that to the search criteria. 
                <?PHP } ?>
                You can also <a href="#" class="toggledetailcolumn">toggle the detail columns</a>. </p-->

        <table class="table-striped table-bordered " width="100%">
			<thead>        
			    <tr style="">
				<th>Name</th>
				<th>Mystery Type</th>
				<th>Effect Type</th>
				<th>Short Desc</th>
				<th>Actions</th>
			    </tr>
			</thead>
			<tbody>

		    <?PHP
		    foreach ($recent as $line) {
			$data = $line->as_array();
			#$data['priest_name'] = $data['priest_name']." (".$data['priest_id'].")";
			echo '<tr>';

			$include = array("mystery_type","effect_type","short_desc", "actions");

                        
			echo '<td><a href="/mysterious/view/'.$data['id'].'">'.$data['name'].'</a></td>';
			foreach ($data as $index => $value) {
                if(in_array($index, $include)){
				    echo '<td>' . ($value ? $value : '&nbsp;') . '</td>';
			    }
			}

			echo '<td><a href="/mysterious/edit/' . $data['id'] . '">Edit</a></td>';

			echo "</tr>\n";
		    }
		    ?>
		</tbody>
	    </table>
	</div>
    </div>
</div>

<script type="text/javascript">
    Altar = {
    
	make_table_sortable : function(){
	    // With customizations
	    $("table").tablesorter();
	    $("table").stickyTableHeaders();
	},
    
        toggle_details: function(){
            $('.detailcolumn').toggle();
        },
    
	add_init : function(){
	    Altar.make_table_sortable();
            $('.detailcolumn').hide();
            $('.toggledetailcolumn').click(Altar.toggle_details);
	}
    
    }
    

    /*! Copyright (c) 2011 by Jonas Mosbech - https://github.com/jmosbech/StickyTableHeaders
    MIT license info: https://github.com/jmosbech/StickyTableHeaders/blob/master/license.txt */

    ;(function ($, window, undefined) {
	'use strict';

	var pluginName = 'stickyTableHeaders';
	var defaults = {
            fixedOffset: 0
        };

	function Plugin (el, options) {
	    // To avoid scope issues, use 'base' instead of 'this'
	    // to reference this class from internal events and functions.
	    var base = this;

	    // Access to jQuery and DOM versions of element
	    base.$el = $(el);
	    base.el = el;

	    // Cache DOM refs for performance reasons
	    base.$window = $(window);
	    base.$clonedHeader = null;
	    base.$originalHeader = null;

	    // Keep track of state
	    base.isCloneVisible = false;
	    base.leftOffset = null;
	    base.topOffset = null;

	    base.init = function () {
		base.options = $.extend({}, defaults, options);

		base.$el.each(function () {
		    var $this = $(this);

		    // remove padding on <table> to fix issue #7
		    $this.css('padding', 0);

		    $this.wrap('<div class="divTableWithFloatingHeader"></div>');

		    base.$originalHeader = $('thead:first', this);
		    base.$clonedHeader = base.$originalHeader.clone();

		    base.$clonedHeader.addClass('tableFloatingHeader');
		    base.$clonedHeader.css({
			'position': 'fixed',
			'top': 0,
			'z-index': 1, // #18: opacity bug
			'display': 'none'
		    });

		    base.$originalHeader.addClass('tableFloatingHeaderOriginal');

		    base.$originalHeader.after(base.$clonedHeader);

		    // enabling support for jquery.tablesorter plugin
		    // forward clicks on clone to original
		    $('th', base.$clonedHeader).click(function (e) {
			var index = $('th', base.$clonedHeader).index(this);
			$('th', base.$originalHeader).eq(index).click();
		    });
		    $this.bind('sortEnd', base.updateWidth);
		});

		base.updateWidth();
		base.toggleHeaders();

		base.$window.scroll(base.toggleHeaders);
		base.$window.resize(base.toggleHeaders);
		base.$window.resize(base.updateWidth);
	    };

	    base.toggleHeaders = function () {
		base.$el.each(function () {
		    var $this = $(this);

		    var newTopOffset = isNaN(base.options.fixedOffset) ?
			base.options.fixedOffset.height() : base.options.fixedOffset;

		    var offset = $this.offset();
		    var scrollTop = base.$window.scrollTop() + newTopOffset;
		    var scrollLeft = base.$window.scrollLeft();

		    if ((scrollTop > offset.top) && (scrollTop < offset.top + $this.height())) {
			var newLeft = offset.left - scrollLeft;
			if (base.isCloneVisible && (newLeft === base.leftOffset) && (newTopOffset === base.topOffset)) {
			    return;
			}

			base.$clonedHeader.css({
			    'top': newTopOffset,
			    'margin-top': 40,
			    'left': newLeft,
			    'display': 'block'
			});
			base.$originalHeader.css('visibility', 'hidden');
			base.isCloneVisible = true;
			base.leftOffset = newLeft;
			base.topOffset = newTopOffset;
		    }
		    else if (base.isCloneVisible) {
			base.$clonedHeader.css('display', 'none');
			base.$originalHeader.css('visibility', 'visible');
			base.isCloneVisible = false;
		    }
		});
	    };

	    base.updateWidth = function () {
		// Copy cell widths and classes from original header
		$('th', base.$clonedHeader).each(function (index) {
		    var $this = $(this);
		    var $origCell = $('th', base.$originalHeader).eq(index);
		    this.className = $origCell.attr('class') || '';
		    $this.css('width', $origCell.width());
		});

		// Copy row width from whole table
		base.$clonedHeader.css('width', base.$originalHeader.width());
	    };

	    // Run initializer
	    base.init();
	}

	// A really lightweight plugin wrapper around the constructor,
	// preventing against multiple instantiations
	$.fn[pluginName] = function ( options ) {
	    return this.each(function () {
		if (!$.data(this, 'plugin_' + pluginName)) {
		    $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
		}
	    });
	};

    })(jQuery, window);

    $(document).ready(Altar.add_init)
</script>
