<style>
    .dataTables_length {
        position: relative;
        bottom: 0;
    }
</style>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data Export</h4>
        <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
        <div class="table-responsive">
            <table class="display table table-striped table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                    <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                    <tr>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12</td>
                        <td>$86,000</td>
                    </tr>
                    <tr>
                        <td>Cedric Kelly</td>
                        <td>Senior Javascript Developer</td>
                        <td>Edinburgh</td>
                        <td>22</td>
                        <td>2012/03/29</td>
                        <td>$433,060</td>
                    </tr>
                    <tr>
                        <td>Airi Satou</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>33</td>
                        <td>2008/11/28</td>
                        <td>$162,700</td>
                    </tr>
                    <tr>
                        <td>Brielle Williamson</td>
                        <td>Integration Specialist</td>
                        <td>New York</td>
                        <td>61</td>
                        <td>2012/12/02</td>
                        <td>$372,000</td>
                    </tr>
                    <tr>
                        <td>Herrod Chandler</td>
                        <td>Sales Assistant</td>
                        <td>San Francisco</td>
                        <td>59</td>
                        <td>2012/08/06</td>
                        <td>$137,500</td>
                    </tr>
                    <tr>
                        <td>Rhona Davidson</td>
                        <td>Integration Specialist</td>
                        <td>Tokyo</td>
                        <td>55</td>
                        <td>2010/10/14</td>
                        <td>$327,900</td>
                    </tr>
                    <tr>
                        <td>Colleen Hurst</td>
                        <td>Javascript Developer</td>
                        <td>San Francisco</td>
                        <td>39</td>
                        <td>2009/09/15</td>
                        <td>$205,500</td>
                    </tr>
                    <tr>
                        <td>Sonya Frost</td>
                        <td>Software Engineer</td>
                        <td>Edinburgh</td>
                        <td>23</td>
                        <td>2008/12/13</td>
                        <td>$103,600</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .dataTables_info {
        /* position: relative !important; */
        /* left: 70% !important; */
        /* display: inline-block !important; */
        /* right: 0 !important; */
    }
</style>
<script>
    $('.table').DataTable({
        dom: 'Bftlp',
        buttons: ['excel'],
        "language": {
            "oPaginate": {
                "sPrevious": "ถอยกลับ",
                "sNext": "ถัดไป"
            },
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            "sLengthMenu": "แสดง _MENU_ รายการ",
            "sSearch": "ค้นหา ",
        }
    });
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn waves-effect waves-light btn-info mx-1');
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').removeClass("dt-button");
    $('.buttons-excel').text("ดาวน์โหลดไฟล์ excel")
</script>