<?php
include 'class/officer.class.php';
$add = new officer();
$race = $add->getRace();
$agencytype = $add->getAgencyType();
$agencyname = $add->getAgencyName();
$cause = $add->getCause();
session_start();
include 'header.php';
?>
<style>
  #country-list {
    float: left;
    list-style: none;
    margin: 0;
    padding: 0;
    width: 190px;
  }

  #country-list li {
    padding: 10px;
    background: #FAFAFA;
    border-bottom: #F0F0F0 1px solid;
  }

  #country-list li:hover {
    background: #F0F0F0;
  }
</style>
<title> Fallen Officer Search - INLEM.org </title>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
  function getAgency(v) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText != '') {
          $("#suggesstion-box").show();
          // $("#suggesstion-box").html(data);
          document.getElementById("suggesstion-box").innerHTML = this.responseText;
          $("#tagname").css("background", "#FFF");
        }
        else {
          $("#suggesstion-box").hide();
        }
      }
    };
    xhttp.open("GET", "get-agency.php?v=" + v, true);
    xhttp.send();
  }
  function selectcountry(val) {
    tval = val.replace(/`/g, "''");
    $("#tagname").val(val);
    $("#agname").val(tval);
    $("#suggesstion-box").hide();
  }
  function setlname(str) {
    str = str.replace(/'/g, "''");
    document.getElementById("lname").value = str;
  }
</script>
</head>

<body class="tw-overflow-x-hidden">
  <?php include 'menu.php'; ?>
  <div class="tw-max-w-screen-xl tw-mx-auto tw-py-8 lg:tw-py-12 tw-space-y-4 tw-px-4">
    <div class="box-body">
      <?php if ($_SESSION['msg'] != "") { ?>
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $_SESSION['msg'];
          $_SESSION['msg'] = ""; ?>
        </div>
      <?php } ?>
    </div>
    <div
      class="tw-space-y-8 lg:tw-space-y-10 tw-bg-white tw-py-8 tw-border tw-rounded-2xl tw-bg-white tw-p-4 lg:tw-px-8 tw-shadow-lg">
      <h3 class="tw-text-2xl lg:tw-text-3xl tw-font-bold tw-text-center">Search for a Fallen Hero</h3>
      <form action="search-officer.php" method="post"
        class="tw-grid tw-grid-cols-2 lg:tw-grid-cols-4 tw-flex-wrap tw-gap-4 tw-items-center">
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-1">
          First Name
          <input type="text" name="tlname" id="tlname"
            class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base"
            onkeyup="setlname(this.value)">
          <input type="hidden" name="lname" id="lname"
            class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base">
        </label>
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-1">
          Race
          <select
            class="tw-text-gray-400 focus:tw-text-gray-900 tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base"
            id="race" name="race">
            <option value="" disabled selected></option>
            <?php
            foreach ($race as $rc) { // display the list
              echo "<option value='" . $rc['r_id'] . "'>" . $rc['r_name'] . "</option>";
            }
            ?>
          </select>
        </label>
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-1">
          Gender
          <select
            class="tw-text-gray-400 focus:tw-text-gray-900 tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base"
            id="gender" name="gender">
            <option value="" disabled selected></option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </label>
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-1">
          Country
          <input type="text" name="county" id="county"
            class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base">
        </label>
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-1">
          Cause of Death
          <select
            class="tw-text-gray-400 focus:tw-text-gray-900 tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base"
            name="cause" id="cause">
            <option value="" disabled selected></option>
            <?php
            foreach ($cause as $st) { // display the list
              echo "<option value='" . $st['cs_id'] . "'>" . $st['cs_name'] . "</option>";
            }
            ?>
          </select>
        </label>
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-2 relative">
          Tag Name
          <input type="text" name="tagname" id="tagname"
            class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base relative"
            onkeyup="getAgency(this.value)">
        </label>
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-1 tw-col-span-2">
          Age
          <div class="tw-flex tw-items-center tw-gap-4">
            <input type="number" min="0" max="2100" name="agefrm" id="agefrm"
              class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base">
            <span class="tw-font-normal">To</span>
            <input type="number" min="0" max="2100" name="ageto" id="ageto"
              class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base">
          </div>
        </label>
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-1 tw-col-span-2">
          Years of Service
          <div class="tw-flex tw-items-center tw-gap-4">
            <input type="number" min="1900" max="2100" name="yrsfrm" id="yrsfrm"
              class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base">
            <span class="tw-font-normal">To</span>
            <input type="number" min="1900" max="2100" name="yrsto" id="yrsto"
              class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base">
          </div>
        </label>
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-1 tw-col-span-2">
          Year of Death
          <div class="tw-flex tw-items-center tw-gap-4">
            <input type="number" min="1900" max="2100" name="dthfrm" id="dthfrm"
              class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base">
            <span class="tw-font-normal">To</span>
            <input type="number" min="1900" max="2100" name="dthto" id="dthto"
              class="tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base">
          </div>
        </label>
        <label class="tw-flex-grow tw-flex tw-flex-col tw-gap-1">
          Agency Type
          <select
            class="tw-text-gray-400 focus:tw-text-gray-900 tw-w-full tw-border tw-border-gray-300 tw-px-4 tw-h-10 tw-rounded-lg tw-font-normal tw-text-base"
            id="agtype" name="agtype">
            <option value="" class="" disabled selected></option>
            <?php
            foreach ($agencytype as $ag) { // display the list
              echo "<option value='" . $ag['at_id'] . "'>" . $ag['at_name'] . "</option>";
            }
            ?>
          </select>
        </label>
        <div class="tw-w-full tw-col-span-full">
          <input type="submit" name="search" value="Search" class="btn-main">
        </div>
      </form>
      <label class="tw-flex tw-justify-center">
        <a target="_blank" href="https://drive.google.com/file/d/1aCe6YnRlDccDmXZPnyG0bQluR3bteTA_/view?usp=sharing"
          class="pdf">
          <span>Indiana Counties Map</span>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_25_177)">
              <path
                d="M21.0826 5.0429L20.7635 4.72386L16.5863 0.546621L16.2672 0.227586C16.1228 0.0831724 15.9226 0 15.7177 0H3.70863C3.21787 0 2.68945 0.379035 2.68945 1.21076V16.1379V22.9808V23.1724C2.68945 23.5188 3.03787 23.8564 3.45 23.9628C3.47069 23.9681 3.49056 23.976 3.51207 23.9801C3.57663 23.993 3.64242 24 3.70863 24H20.291C20.3572 24 20.423 23.993 20.4875 23.9801C20.509 23.976 20.5289 23.9681 20.5496 23.9628C20.9617 23.8564 21.3101 23.5188 21.3101 23.1724V22.9808V16.1379V5.784C21.3101 5.46662 21.2721 5.23241 21.0826 5.0429ZM19.835 4.96552H16.3446V1.47517L19.835 4.96552ZM3.70863 23.1724C3.67925 23.1724 3.65276 23.1617 3.62669 23.1521C3.56214 23.1215 3.51704 23.057 3.51704 22.9808V16.9655H20.4826V22.9808C20.4826 23.057 20.4375 23.1211 20.3729 23.1521C20.3468 23.1617 20.3203 23.1724 20.291 23.1724H3.70863ZM3.51704 16.1379V1.21076C3.51704 1.12097 3.53069 0.827586 3.70863 0.827586H15.541C15.5274 0.879724 15.517 0.933517 15.517 0.989379V5.7931H20.3208C20.3766 5.7931 20.43 5.78276 20.4821 5.7691C20.4821 5.77531 20.4826 5.77779 20.4826 5.784V16.1379H3.51704Z"
                fill="currentColor" />
              <path
                d="M9.12057 18.5148C8.98278 18.4019 8.82719 18.3166 8.65381 18.2604C8.48043 18.2037 8.30499 18.1755 8.12788 18.1755H6.92871V22.3449H7.60774V20.84H8.11133C8.32981 20.84 8.53009 20.8081 8.71092 20.744C8.89175 20.6798 9.0465 20.5892 9.17478 20.4725C9.30306 20.3558 9.40278 20.2114 9.47478 20.0397C9.54637 19.868 9.58237 19.6768 9.58237 19.4653C9.58237 19.2655 9.53975 19.0855 9.45492 18.9249C9.37009 18.7644 9.25837 18.6282 9.12057 18.5148ZM8.86319 19.8924C8.8214 20.0074 8.76719 20.0968 8.69933 20.1609C8.63147 20.2251 8.55699 20.2714 8.47588 20.2995C8.39478 20.3277 8.31243 20.3422 8.22968 20.3422H7.60733V18.6903H8.1163C8.28968 18.6903 8.42912 18.7176 8.53506 18.7722C8.64057 18.8268 8.7225 18.8947 8.78126 18.9758C8.83961 19.0569 8.87809 19.1417 8.89712 19.2303C8.91575 19.3188 8.92526 19.3971 8.92526 19.4649C8.92526 19.635 8.90457 19.7773 8.86319 19.8924Z"
                fill="currentColor" />
              <path
                d="M13.2222 18.7863C13.0467 18.6017 12.8262 18.4532 12.5601 18.3423C12.294 18.2314 11.9857 18.1755 11.6353 18.1755H10.3794V22.3449H11.9576C12.0102 22.3449 12.0913 22.3383 12.2009 22.3251C12.3102 22.3118 12.431 22.282 12.563 22.2344C12.695 22.1873 12.8315 22.1165 12.973 22.0222C13.1146 21.9278 13.2416 21.7987 13.355 21.6344C13.4684 21.4702 13.5615 21.2666 13.6351 21.0233C13.7088 20.78 13.7456 20.4866 13.7456 20.1435C13.7456 19.8944 13.7022 19.652 13.6157 19.4165C13.5284 19.1815 13.3976 18.9713 13.2222 18.7863ZM12.7273 21.4056C12.5237 21.6998 12.1918 21.8467 11.7317 21.8467H11.0584V18.6899H11.4544C11.7788 18.6899 12.0428 18.7325 12.2464 18.8173C12.45 18.9022 12.6114 19.0135 12.7302 19.1513C12.8489 19.2891 12.9288 19.4426 12.9706 19.6122C13.0119 19.7819 13.0326 19.9536 13.0326 20.127C13.0326 20.6852 12.9308 21.1118 12.7273 21.4056Z"
                fill="currentColor" />
              <path d="M14.73 22.3449H15.4202V20.4667H17.1627V20.0028H15.4202V18.6903H17.3377V18.1755H14.73V22.3449Z"
                fill="currentColor" />
              <path
                d="M15.901 9.50114C15.5207 9.50114 15.054 9.55079 14.5115 9.64928C13.7542 8.84569 12.9639 7.67217 12.4061 6.52017C12.9593 4.19093 12.6825 3.86114 12.5604 3.70555C12.4305 3.54004 12.2472 3.27148 12.0387 3.27148C11.9513 3.27148 11.713 3.31121 11.6182 3.34266C11.3799 3.42211 11.2516 3.60583 11.149 3.84542C10.8564 4.52942 11.2578 5.69548 11.6708 6.59424C11.3178 7.99824 10.7257 9.67866 10.1033 11.0425C8.53507 11.7609 7.7021 12.4664 7.62679 13.1396C7.59948 13.3846 7.65741 13.7442 8.08817 14.0673C8.2061 14.1555 8.34431 14.2022 8.48831 14.2022C8.85038 14.2022 9.21617 13.925 9.63948 13.3304C9.94817 12.8967 10.2796 12.3054 10.6256 11.5713C11.7337 11.0868 13.1046 10.649 14.2785 10.4036C14.9323 11.0313 15.5178 11.3491 16.021 11.3491C16.3918 11.3491 16.7096 11.1787 16.9396 10.8563C17.1792 10.5207 17.2338 10.2203 17.101 9.96252C16.9417 9.65259 16.549 9.50114 15.901 9.50114ZM8.49741 13.5038C8.30376 13.3552 8.31493 13.2551 8.31907 13.2174C8.34472 12.9873 8.70514 12.5789 9.58941 12.082C8.91907 13.32 8.55907 13.4843 8.49741 13.5038ZM11.8905 4.01879C11.9083 4.013 12.3229 4.47438 11.9302 5.34955C11.3402 4.74583 11.85 4.03245 11.8905 4.01879ZM11.0352 10.6502C11.4552 9.64928 11.8458 8.54404 12.1417 7.52031C12.6064 8.35535 13.1646 9.16555 13.7232 9.81438C12.8402 10.0217 11.9 10.3142 11.0352 10.6502ZM16.3736 10.452C16.2461 10.6304 15.9697 10.6345 15.8729 10.6345C15.6523 10.6345 15.57 10.5033 15.2327 10.2439C15.5108 10.2083 15.7731 10.1992 15.9821 10.1992C16.35 10.1992 16.4174 10.2534 16.4683 10.2807C16.4592 10.3101 16.4352 10.3656 16.3736 10.452Z"
                fill="currentColor" />
            </g>
            <defs>
              <clipPath id="clip0_25_177">
                <rect width="24" height="24" fill="white" />
              </clipPath>
            </defs>
          </svg>
        </a>
      </label>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <script>
    (function (i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date(); a = s.createElement(o), m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga'); ga('create', 'UA-89052607-2', 'auto'); ga('send', 'pageview');
  </script>
</body>

</html>