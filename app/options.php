      <span> Configure the paging options in the table</span><br />
      <form action="">
        <span >Number of rows:</span>
        <select onchange="setNumberOfPages(this.value)">
          <option value="">No paging</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option selected="selected" value="25">25</option>
          <option value="50">50</option>
        </select>
        <span>Configure buttons enabled/disabled</span>
          <select id='enable-paging-buttons' onchange='setPagingButtonsConfiguration(this.value)'>
            <option value=''>Default (auto)</option>
            <option value='prev'>prev</option>
            <option value='next'>next</option>
            <option value='both'>both</option>
         </select>
      </form>

