<!-- main.php -->
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!-- Content Section -->
<main class="col-12 col-lg-9 col-xl-10 content">
    <h2>Create a New Post</h2>
    <form action="../postControler.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Publish To:</label>
            
            <!-- Discord Checkbox with Channel List -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="discord" name="platforms[]" value="Discord" onclick="toggleDiscordChannels()">
                <label class="form-check-label" for="discord">Discord</label>
            </div>
            <div id="discordChannels" style="display:none; margin-left: 20px;">
                <label class="form-label">Select Discord Channels:</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="nifty-vip">
                    <label class="form-check-label">nifty-vip</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="forex-vip">
                    <label class="form-check-label">forex-vip</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="crypto-vip">
                    <label class="form-check-label">crypto-vip</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="vip-chat">
                    <label class="form-check-label">vip-chat</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="nifty-market-updates">
                    <label class="form-check-label">nifty-market-updates</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="crypto-market-updates">
                    <label class="form-check-label">crypto-market-updates</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="forex-market-updates">
                    <label class="form-check-label">forex-market-updates</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="strategies">
                    <label class="form-check-label">strategies</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="learning-centre">
                    <label class="form-check-label">learning-centre</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="risk-management-in-a-nutshell">
                    <label class="form-check-label">risk-management-in-a-nutshell</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="all-in-1-journal">
                    <label class="form-check-label">all-in-1-journal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="discord_channels[]" value="active-trades">
                    <label class="form-check-label">active-trades</label>
                </div>
            </div>
            
            <!-- Telegram and Twitter Checkboxes -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="telegram" name="platforms[]" value="Telegram">
                <label class="form-check-label" for="telegram">Telegram</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="twitter" name="platforms[]" value="Twitter">
                <label class="form-check-label" for="twitter">Twitter</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Publish</button>
    </form>
</main>

<?php include 'footer.php'; ?>

<script>
function toggleDiscordChannels() {
    const discordCheckbox = document.getElementById("discord");
    const discordChannels = document.getElementById("discordChannels");
    discordChannels.style.display = discordCheckbox.checked ? "block" : "none";
}
</script>
