
        <div id="content">
            <div id="wrapper">
                <div id="steps">
                    <form id="formElem" name="formElem" action="" method="post">
                        <fieldset class="step">
                            <h2>Home Loan Quote</h2>
                            <h3>Complete to receive a personalized home loan quote</h3>
                            <div class="wrapper-form-elements">
                                <?php echo drupal_render($form['loan_type'])?>
                                <?php echo drupal_render($form['property_type'])?>
                                <?php echo drupal_render($form['purchase_goal'])?>
                            </div>
                            <div class="navigation"><div class="next-btn button">Next</div></div>
                        </fieldset>
                        <fieldset class="step">
                           <h2>Home Loan Quote</h2>
                            <h3>Complete to receive a personalized home loan quote</h3>
                            <p>
                                <label for="name">Full Name</label>
                                <input id="name" name="name" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="country">Country</label>
                                <input id="country" name="country" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="phone">Phone</label>
                                <input id="phone" name="phone" placeholder="e.g. +351215555555" type="tel" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="website">Website</label>
                                <input id="website" name="website" placeholder="e.g. http://www.codrops.com" type="tel" AUTOCOMPLETE=OFF />
                            </p>
                            <div class="navigation">
	                            <div class="prev-btn button">Prev</div>
	                            <div class="next-btn button">Next</div>
                            </div>
                        </fieldset>
                        <fieldset class="step">
                              <h2>Home Loan Quote</h2>
                            <h3>Complete to receive a personalized home loan quote</h3>
                            <p>
                                <label for="cardtype">Card</label>
                                <select id="cardtype" name="cardtype">
                                    <option>Visa</option>
                                    <option>Mastercard</option>
                                    <option>American Express</option>
                                </select>
                            </p>
                            <p>
                                <label for="cardnumber">Card number</label>
                                <input id="cardnumber" name="cardnumber" type="number" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="secure">Security code</label>
                                <input id="secure" name="secure" type="number" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="namecard">Name on Card</label>
                                <input id="namecard" name="namecard" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <div class="navigation">
	                            <div class="prev-btn button">Prev</div>
	                            <div class="next-btn button">Next</div>
                            </div>
                        </fieldset>
                        <fieldset class="step">
                            <h2>Home Loan Quote</h2>
                            <h3>Complete to receive a personalized home loan quote</h3>
                            <p>
                                <label for="newsletter">Newsletter</label>
                                <select id="newsletter" name="newsletter">
                                    <option value="Daily" selected>Daily</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Never">Never</option>
                                </select>
                            </p>
                            <p>
                                <label for="updates">Updates</label>
                                <select id="updates" name="updates">
                                    <option value="1" selected>Package 1</option>
                                    <option value="2">Package 2</option>
                                    <option value="0">Don't send updates</option>
                                </select>
                            </p>
							<p>
                                <label for="tagname">Newsletter Tag</label>
                                <input id="tagname" name="tagname" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <div class="navigation">
	                            <div class="prev-btn button">Prev</div>
                            </div>
                             <p>
                                <?php echo drupal_render($form['submit_button'])?>
                            </p>
                        </fieldset>
                        <fieldset class="step">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
  <Style>
  .wrapper-form-elements {
   width: 200px;
  }

  .navigation .button {
    background-color: #25bffb;
    color: white;
    margin: 5px;
    display: block;
    height: 40px;
    line-height: 40px;
    text-decoration: none;
    width: 100px;
    text-align: center;
}
  #wrapper{
    -moz-box-shadow:0px 0px 3px #aaa;
    -webkit-box-shadow:0px 0px 3px #aaa;
    box-shadow:0px 0px 3px #aaa;
    -moz-border-radius:10px;
    -webkit-border-radius:10px;
    border-radius:10px;
    border:2px solid #fff;
    background-color:#f9f9f9;
    width:1020px;
    overflow:hidden;
}
#steps{
    width:1020px;
	/*height:320px;*/
    overflow:hidden;
}
.step{
    float:left;
    width:1020px;
	/*height:320px;*/
}
#navigation{
    height:45px;
    background-color:#e9e9e9;
    border-top:1px solid #fff;
    -moz-border-radius:0px 0px 10px 10px;
    -webkit-border-bottom-left-radius:10px;
    -webkit-border-bottom-right-radius:10px;
    border-bottom-left-radius:10px;
    border-bottom-right-radius:10px;
}
#navigation ul{
    list-style:none;
	float:left;
	margin-left:22px;
}
#navigation ul li{
	float:left;
    border-right:1px solid #ccc;
    border-left:1px solid #ccc;
    position:relative;
	margin:0px 2px;
}
#navigation ul li a{
    display:block;
    height:45px;
    background-color:#444;
    color:#777;
    outline:none;
    font-weight:bold;
    text-decoration:none;
    line-height:45px;
    padding:0px 20px;
    border-right:1px solid #fff;
    border-left:1px solid #fff;
    background:#f0f0f0;
    background:
        -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0.09, rgb(240,240,240)),
        color-stop(0.55, rgb(227,227,227)),
        color-stop(0.78, rgb(240,240,240))
        );
    background:
        -moz-linear-gradient(
        center bottom,
        rgb(240,240,240) 9%,
        rgb(227,227,227) 55%,
        rgb(240,240,240) 78%
        )
}
#navigation ul li a:hover,
#navigation ul li.selected a{
    background:#d8d8d8;
    color:#666;
    text-shadow:1px 1px 1px #fff;
}
span.checked{
    background:transparent url(../images/checked.png) no-repeat top left;
    position:absolute;
    top:0px;
    left:1px;
    width:20px;
    height:20px;
}
span.error{
    background:transparent url(../images/error.png) no-repeat top left;
    position:absolute;
    top:0px;
    left:1px;
    width:20px;
    height:20px;
}
#steps form fieldset{
    border:none;
    padding-bottom:20px;
}
#steps form legend{
    text-align:left;
    background-color:#f0f0f0;
    color:#666;
    font-size:24px;
    text-shadow:1px 1px 1px #fff;
    font-weight:bold;
    float:left;
    width:590px;
    padding:5px 0px 5px 10px;
    margin:10px 0px;
    border-bottom:1px solid #fff;
    border-top:1px solid #d9d9d9;
}
#steps form p{
    float:left;
    clear:both;
    margin:5px 0px;
    background-color:#f4f4f4;
    border:1px solid #fff;
    width:400px;
    padding:10px;
    margin-left:100px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow:0px 0px 3px #aaa;
    -webkit-box-shadow:0px 0px 3px #aaa;
    box-shadow:0px 0px 3px #aaa;
}
#steps form p label{
    width:160px;
    float:left;
    text-align:right;
    margin-right:15px;
    line-height:26px;
    color:#666;
    text-shadow:1px 1px 1px #fff;
    font-weight:bold;
}
#steps form input:not([type=radio]),
#steps form textarea,
#steps form select{
    background: #ffffff;
    border: 1px solid #ddd;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    outline: none;
    padding: 5px;
    width: 200px;
    float:left;
}
#steps form input:focus{
    -moz-box-shadow:0px 0px 3px #aaa;
    -webkit-box-shadow:0px 0px 3px #aaa;
    box-shadow:0px 0px 3px #aaa;
    background-color:#FFFEEF;
}
#steps form p.submit{
    background:none;
    border:none;
    -moz-box-shadow:none;
    -webkit-box-shadow:none;
    box-shadow:none;
}
#steps form button {
	border:none;
	outline:none;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    color: #ffffff;
    display: block;
    cursor:pointer;
    margin: 0px auto;
    clear:both;
    padding: 7px 25px;
    text-shadow: 0 1px 1px #777;
    font-weight:bold;
    font-family:"Century Gothic", Helvetica, sans-serif;
    font-size:22px;
    -moz-box-shadow:0px 0px 3px #aaa;
    -webkit-box-shadow:0px 0px 3px #aaa;
    box-shadow:0px 0px 3px #aaa;
    background:#4797ED;
}
#steps form button:hover {
    background:#d8d8d8;
    color:#666;
    text-shadow:1px 1px 1px #fff;
}
  </Style>