<form role="search" method="get" class="pmx-search-form" action="<?php echo home_url('/'); ?>">
    <input type="checkbox" class="pmx-search-form-checkbox" id="pmx-search-form-checkbox" />
    <label class="pmx-search-form-label" for="pmx-search-form-checkbox" ><i class="fa fa-search"></i></label>
    <div class="pmx-search-form-field-container" >
        <input type="search" class="pmx-search-form-field" placeholder="Pesquisar …" value="<?php echo get_search_query(); ?>" name="s">
    </div>
</form>