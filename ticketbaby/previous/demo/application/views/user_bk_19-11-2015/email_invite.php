<table width="560" cellspacing="0" cellpadding="0" style="margin:0 auto;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:13px;background-image:url(<?php echo base_url();?>images/table.png);background-color:#f4f9f7">
                                            <tbody><tr><td><u></u>
                                                </td></tr><tr>
                                                    <td width="29"></td>
                                                    <td width="500" style="color:#404040;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;text-align:left">
                                                        <div style="text-align:center;margin-top:30px;margin-bottom:0px">
                                                            <p style="font-size:17px;line-height:21px">
                                                                <strong style="display:inline">
                                                                        <span style="color:#404040">
                                                                            Hello,
                                                                        </span>
                                                                </strong>
                                                                <br>
                                                                <span style="font-size:13px;font-weight:400;line-height:18px;margin-top:0;color:#404040">
                                                                    You are invited to the following event:
                                                                </span>
                                                            </p>
                                                            <a style="font-size:24px;line-height:26px;text-transform:uppercase;color:#0f90ba;text-decoration:none" href="#" target="_blank">
                                                                <?php echo ucwords($event_details['title']);?>
                                                            </a>
                                                        </div>


                                                        <div style="margin-top:24px">
                                                            <img src="<?php echo base_url();?>images/email_img.png" alt="divider" width="500" height="8" class="CToWUd">
                                                        </div>

                                                        <div style="margin-top:24px">
                                                            <p style="line-height:18px;margin-top:0px;color:#404040">
                                                                    Event to be held at the following time and date:
                                                            </p>
                                                        </div>

                                                        
                                                        <table width="500" border="0" cellspacing="0" cellpadding="0">
                                                            <tbody><tr>

                                                                <td width="250" valign="top" style="font-size:13px;line-height:18px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">
                                                                    <p style="color:#404040;width:200px">
                                                                        <span class="aBn" data-term="goog_1958510381" tabindex="0"><span class="aQJ"> <?php echo date('D, M d, Y  h:i A',strtotime(($event_details['start_date'])));?></span></span><div class="aSS" style="left: 153.5px; top: 273px; width: 172px; height: 16px;"></div> <br><span>- to -</span><br> <span class="aBn" data-term="goog_1958510382" tabindex="0"><span class="aQJ"><?php echo date('D, M d, Y  h:i A',strtotime(($event_details['end_date'])));?></span></span>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>

                                                        <table width="500" border="0" cellpadding="0" cellspacing="0" style="font-size:14px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;line-height:18px;margin:20px 0 24px 0">
                                                            <tbody><tr>
                                                                <td width="250" valign="middle">
                                                                    <div>
                                                                        
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tbody><tr>
              <td align="center" style="border-radius:5px;background:url(<?php echo base_url();?>images/sm_blank.png) repeat-x 0 50% #95c033" bgcolor="#95c033">
                  <a href="<?php echo $href;?>" style="font-size:15px;font-weight:bold;font-family:Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;border-radius:5px;padding:10px 18px;border:1px solid #8bae42;display:inline-block" target="_blank">
                      <strong style="color:#ffffff">Attend Event</strong>
                  </a>
              </td>
            </tr>
          </tbody></table>
        </td>
      </tr>
    </tbody>
	</table>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tbody><tr>
              <td align="center" style="border-radius:5px;background:url(<?php echo base_url();?>images/sm_blank.png) repeat-x 0 50% #95c033" bgcolor="#95c033">
                  <a href="<?php echo $preview;?>" style="font-size:15px;font-weight:bold;font-family:Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;border-radius:5px;padding:10px 18px;border:1px solid #8bae42;display:inline-block" target="_blank">
                      <strong style="color:#ffffff">Preview</strong>
                  </a>
              </td>
            </tr>
          </tbody></table>
        </td>
      </tr>
    </tbody></table>

                                                                    </div>
                                                                </td>

                                                                <!--td width="250" valign="middle">
                                                                    <div style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:13px;line-height:18px">
                                                                        <p style="margin:0;padding:0">
                                                                            <strong style="color:#404040;display:inline">Share this event:</strong>
                                                                        </p>
                                                                        <table cellpadding="0" cellspacing="0" border="0" style="border:0">
                                                                            <tbody><tr style="border:0">
                                                                                <td style="padding:3px 3px 0 0;border:0">
                                                                                    <a href="http://www.facebook.com/share.php?u=http%3A%2F%2Fwww.eventbrite.com%2Fe%2F19248410514%3Fref%3Desfb%26utm_campaign%3D201308%26utm_source%3DFacebookenivtefor001" style="text-decoration:none;display:inline" target="_blank">
                                                                                        <img src="https://ci6.googleusercontent.com/proxy/uZNhZyKnOUouOqKIL0l2bofAlFj3uv8BidnRR5bDQtGueGzdzh51xr12ZQL1GY3S4jpUoJ1WiFCRwpKGT4fcTs6uYgIb5aqIPcGYDrLCXKQe8Gwi8M4-ojMHhbwz2yhkRQ=s0-d-e1-ft#https://cdn.evbstatic.com/s3-s3/marketing/emails/invites/facebook-share.png" alt="Facebook" title="Facebook" style="border:0" height="20" width="20" class="CToWUd">
                                                                                    </a>
                                                                                </td>
                                                                                <td style="padding:3px 3px 0 0;border:0">
                                                                                    <a href="http://twitter.com/home?status=I%27m+attending+re+--+https%3A%2F%2Fwww.eventbrite.com%2Fe%2Fre-tickets-19248410514%3Fref%3Destwenivtefor001" style="text-decoration:none;display:inline" target="_blank">
                                                                                        <img src="https://ci4.googleusercontent.com/proxy/fK9gDEPPHk6yHzs5gP7lNlGlb67uER0eShHGKSLUs6e9vQ-bF3hnhUsURwrhFwNZBwqvSuuAJkG3UYKQ9I6lIFabLjyUxPL5YsIY9FHWM94SKksFJjzGuEJ5CKlCTAsm=s0-d-e1-ft#https://cdn.evbstatic.com/s3-s3/marketing/emails/invites/twitter-share.png" alt="Twitter" title="Twitter" style="border:0" height="20" width="20" class="CToWUd">
                                                                                    </a>
                                                                                </td>
                                                                                <td style="padding:3px 3px 0 0;border:0">
                                                                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https%3A%2F%2Fwww.eventbrite.com%2Fe%2Fre-tickets-19248410514%3Fref%3Desli%26utm_campaign%3D201308%26utm_source%3DLinkedInenivtefor001&amp;title=re&amp;summary=%5BDec+25%2C+2015+-+Dec+27%2C+2015%5D+-+%5B%5D&amp;source=Eventbrite" style="text-decoration:none;display:inline" target="_blank">
                                                                                        <img src="https://ci6.googleusercontent.com/proxy/GNQRqHKkOokxPKDccbVZi8JZEig-Ka4u3zSEEmknbgTF02VWyRpHZj0n41IAbeigAZxjmCzzkFnS0A6IxQSop9oVMIRRJnGSoq_PHt_r1y-APUd8Mkvxe-07G4_pOsNmTw=s0-d-e1-ft#https://cdn.evbstatic.com/s3-s3/marketing/emails/invites/linkedin-share.png" alt="LinkedIn" title="LinkedIn" style="border:0" height="20" width="20" class="CToWUd">
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                </div>
                                                                </td-->
                                                            </tr>
                                                        </tbody></table>


                                                        <img src="<?php echo base_url();?>images/email_img.png" alt="divider" width="500" height="8" class="CToWUd">

                                                        <table width="500" border="0" cellpadding="0" cellspacing="0" style="font-size:13px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;line-height:18px;padding:20px 0 24px 0">
                                                            <tbody><tr>
                                                                <td>
                                                                    <div width="500" style="word-break:break-word;overflow:hidden">
                                                                        <div style="color:#404040">
                                                                            <p><br></p>
<div><br></div><br><br><br><!--Share this event on <a style="color:#0f90ba;text-decoration:none" href="http://www.facebook.com/share.php?u=https%3A//www.eventbrite.com/e/re-tickets-19248410514%3Fref%3Desfb" rel="nofollow" target="_blank">Facebook</a>
                    and <a style="color:#0f90ba;text-decoration:none" href="http://twitter.com/home?status=https%3A//www.eventbrite.com/e/re-tickets-19248410514%3Fref%3Destw" rel="nofollow" target="_blank">Twitter</a><br><br>
                   --> We hope you can make it!<br><br>Cheers,<br>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>

                                                    </td>
                                                    <td width="29"></td>
                                                </tr>
                                            </tbody></table>