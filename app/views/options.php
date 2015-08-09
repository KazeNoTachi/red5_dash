<span> Configure the paging options in the table</span><br />
      <form action="">
        <span style="font-size: 12px;">Number of rows:</span>
        <select style="font-size: 12px" onchange="setNumberOfPages(this.value)">
          <option value="">No paging</option>
          <option value="3">3</option>
          <option value="5">5</option>
          <option value="9">9</option>
          <option selected="selected" value="10">10</option>
          <option value="100">100</option>
        </select>
        <span style="padding-left: 5px; font-size: 12px;">Custom paging symbols </span>
        <input type="checkbox" checked="checked" onclick="setCustomPagingButtons(this.checked)">
        <span style="padding-left: 5px; font-size: 12px">Configure buttons enabled/disabled</span>
          <select style="font-size: 12px" id='enable-paging-buttons' onchange='setPagingButtonsConfiguration(this.value)'>
            <option value=''>Default (auto)</option>
            <option value='prev'>prev</option>
            <option value='next'>next</option>
            <option value='both'>both</option>
         </select>
      </form>
<hr><center><h1>Filters</center></h1><hr>
