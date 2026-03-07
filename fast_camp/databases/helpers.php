<?php
declare(strict_types=1);

const OTP_SECRET_KEY = 'fastcamp_secret_key_2024';
const OTP_EXPIRY_SECONDS = 1800; // 30 minutes
const OTP_LENGTH = 6;

function generateStatelessOtp(int $userId, int $activityId): array
{
    $timeWindow = floor(time() / OTP_EXPIRY_SECONDS);
    $data = "{$userId}:{$activityId}:{$timeWindow}";
    $hash = hash_hmac('sha256', $data, OTP_SECRET_KEY);
    $decimal = hexdec(substr($hash, 0, 16));
    $otp = str_pad((string)($decimal % 1000000), OTP_LENGTH, '0', STR_PAD_LEFT);
    $expiresAt = (int)(($timeWindow + 1) * OTP_EXPIRY_SECONDS);
    $expiresIn = $expiresAt - time();
    if ($expiresIn < 0) {
        $expiresIn = OTP_EXPIRY_SECONDS - (time() % OTP_EXPIRY_SECONDS);
    }
    return [
        'code' => $otp,
        'expires_at' => date('Y-m-d H:i:s', $expiresAt),
        'expires_in' => $expiresIn
    ];
}

function verifyStatelessOtp(string $otpCode, int $userId, int $activityId): bool
{
    $otpCode = strtolower(trim($otpCode));
    $currentWindow = floor(time() / OTP_EXPIRY_SECONDS);
    $windows = [$currentWindow, $currentWindow - 1];
    
    foreach ($windows as $window) {
        $data = "{$userId}:{$activityId}:{$window}";
        $hash = hash_hmac('sha256', $data, OTP_SECRET_KEY);
        $decimal = hexdec(substr($hash, 0, 16));
        $expectedOtp = str_pad((string)($decimal % 1000000), OTP_LENGTH, '0', STR_PAD_LEFT);
        if (hash_equals($expectedOtp, $otpCode)) {
            return true;
        }
    }
    return false;
}

function getCurrentOtp(int $userId, int $activityId): ?array
{
    return generateStatelessOtp($userId, $activityId);
}

function getAvatarUrl(string $seed, string $style = 'micah'): string
{
    return "https://api.dicebear.com/9.x/{$style}/svg?seed=" . urlencode($seed);
}
