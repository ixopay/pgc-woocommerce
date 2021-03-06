<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc3540edbd68b1df48d0447c874511d41
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'PaymentGatewayCloud\\Client\\' => 27,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'PaymentGatewayCloud\\Client\\' => 
        array (
            0 => __DIR__ . '/../../..' . '/classes/client',
        ),
    );

    public static $classMap = array (
        'PaymentGatewayCloud\\Client\\Callback\\ChargebackData' => __DIR__ . '/../../..' . '/classes/client/Callback/ChargebackData.php',
        'PaymentGatewayCloud\\Client\\Callback\\ChargebackReversalData' => __DIR__ . '/../../..' . '/classes/client/Callback/ChargebackReversalData.php',
        'PaymentGatewayCloud\\Client\\Callback\\Result' => __DIR__ . '/../../..' . '/classes/client/Callback/Result.php',
        'PaymentGatewayCloud\\Client\\Client' => __DIR__ . '/../../..' . '/classes/client/Client.php',
        'PaymentGatewayCloud\\Client\\CustomerProfile\\CustomerData' => __DIR__ . '/../../..' . '/classes/client/CustomerProfile/CustomerData.php',
        'PaymentGatewayCloud\\Client\\CustomerProfile\\DeleteProfileResponse' => __DIR__ . '/../../..' . '/classes/client/CustomerProfile/DeleteProfileResponse.php',
        'PaymentGatewayCloud\\Client\\CustomerProfile\\GetProfileResponse' => __DIR__ . '/../../..' . '/classes/client/CustomerProfile/GetProfileResponse.php',
        'PaymentGatewayCloud\\Client\\CustomerProfile\\PaymentData\\CardData' => __DIR__ . '/../../..' . '/classes/client/CustomerProfile/PaymentData/CardData.php',
        'PaymentGatewayCloud\\Client\\CustomerProfile\\PaymentData\\IbanData' => __DIR__ . '/../../..' . '/classes/client/CustomerProfile/PaymentData/IbanData.php',
        'PaymentGatewayCloud\\Client\\CustomerProfile\\PaymentData\\PaymentData' => __DIR__ . '/../../..' . '/classes/client/CustomerProfile/PaymentData/PaymentData.php',
        'PaymentGatewayCloud\\Client\\CustomerProfile\\PaymentData\\WalletData' => __DIR__ . '/../../..' . '/classes/client/CustomerProfile/PaymentData/WalletData.php',
        'PaymentGatewayCloud\\Client\\CustomerProfile\\PaymentInstrument' => __DIR__ . '/../../..' . '/classes/client/CustomerProfile/PaymentInstrument.php',
        'PaymentGatewayCloud\\Client\\CustomerProfile\\UpdateProfileResponse' => __DIR__ . '/../../..' . '/classes/client/CustomerProfile/UpdateProfileResponse.php',
        'PaymentGatewayCloud\\Client\\Data\\CreditCardCustomer' => __DIR__ . '/../../..' . '/classes/client/Data/CreditCardCustomer.php',
        'PaymentGatewayCloud\\Client\\Data\\Customer' => __DIR__ . '/../../..' . '/classes/client/Data/Customer.php',
        'PaymentGatewayCloud\\Client\\Data\\Data' => __DIR__ . '/../../..' . '/classes/client/Data/Data.php',
        'PaymentGatewayCloud\\Client\\Data\\IbanCustomer' => __DIR__ . '/../../..' . '/classes/client/Data/IbanCustomer.php',
        'PaymentGatewayCloud\\Client\\Data\\Item' => __DIR__ . '/../../..' . '/classes/client/Data/Item.php',
        'PaymentGatewayCloud\\Client\\Data\\Request' => __DIR__ . '/../../..' . '/classes/client/Data/Request.php',
        'PaymentGatewayCloud\\Client\\Data\\Result\\CreditcardData' => __DIR__ . '/../../..' . '/classes/client/Data/Result/CreditcardData.php',
        'PaymentGatewayCloud\\Client\\Data\\Result\\IbanData' => __DIR__ . '/../../..' . '/classes/client/Data/Result/IbanData.php',
        'PaymentGatewayCloud\\Client\\Data\\Result\\PhoneData' => __DIR__ . '/../../..' . '/classes/client/Data/Result/PhoneData.php',
        'PaymentGatewayCloud\\Client\\Data\\Result\\ResultData' => __DIR__ . '/../../..' . '/classes/client/Data/Result/ResultData.php',
        'PaymentGatewayCloud\\Client\\Data\\Result\\WalletData' => __DIR__ . '/../../..' . '/classes/client/Data/Result/WalletData.php',
        'PaymentGatewayCloud\\Client\\Exception\\ClientException' => __DIR__ . '/../../..' . '/classes/client/Exception/ClientException.php',
        'PaymentGatewayCloud\\Client\\Exception\\InvalidValueException' => __DIR__ . '/../../..' . '/classes/client/Exception/InvalidValueException.php',
        'PaymentGatewayCloud\\Client\\Exception\\RateLimitException' => __DIR__ . '/../../..' . '/classes/client/Exception/RateLimitException.php',
        'PaymentGatewayCloud\\Client\\Exception\\TimeoutException' => __DIR__ . '/../../..' . '/classes/client/Exception/TimeoutException.php',
        'PaymentGatewayCloud\\Client\\Exception\\TypeException' => __DIR__ . '/../../..' . '/classes/client/Exception/TypeException.php',
        'PaymentGatewayCloud\\Client\\Http\\ClientInterface' => __DIR__ . '/../../..' . '/classes/client/Http/ClientInterface.php',
        'PaymentGatewayCloud\\Client\\Http\\CurlClient' => __DIR__ . '/../../..' . '/classes/client/Http/CurlClient.php',
        'PaymentGatewayCloud\\Client\\Http\\CurlExec' => __DIR__ . '/../../..' . '/classes/client/Http/CurlExec.php',
        'PaymentGatewayCloud\\Client\\Http\\Exception\\ClientException' => __DIR__ . '/../../..' . '/classes/client/Http/Exception/ClientException.php',
        'PaymentGatewayCloud\\Client\\Http\\Exception\\ResponseException' => __DIR__ . '/../../..' . '/classes/client/Http/Exception/ResponseException.php',
        'PaymentGatewayCloud\\Client\\Http\\Response' => __DIR__ . '/../../..' . '/classes/client/Http/Response.php',
        'PaymentGatewayCloud\\Client\\Http\\ResponseInterface' => __DIR__ . '/../../..' . '/classes/client/Http/ResponseInterface.php',
        'PaymentGatewayCloud\\Client\\Json\\DataObject' => __DIR__ . '/../../..' . '/classes/client/Json/DataObject.php',
        'PaymentGatewayCloud\\Client\\Json\\ErrorResponse' => __DIR__ . '/../../..' . '/classes/client/Json/ErrorResponse.php',
        'PaymentGatewayCloud\\Client\\Json\\ResponseObject' => __DIR__ . '/../../..' . '/classes/client/Json/ResponseObject.php',
        'PaymentGatewayCloud\\Client\\Schedule\\ScheduleData' => __DIR__ . '/../../..' . '/classes/client/Schedule/ScheduleData.php',
        'PaymentGatewayCloud\\Client\\Schedule\\ScheduleError' => __DIR__ . '/../../..' . '/classes/client/Schedule/ScheduleError.php',
        'PaymentGatewayCloud\\Client\\Schedule\\ScheduleResult' => __DIR__ . '/../../..' . '/classes/client/Schedule/ScheduleResult.php',
        'PaymentGatewayCloud\\Client\\StatusApi\\StatusRequestData' => __DIR__ . '/../../..' . '/classes/client/StatusApi/StatusRequestData.php',
        'PaymentGatewayCloud\\Client\\StatusApi\\StatusResult' => __DIR__ . '/../../..' . '/classes/client/StatusApi/StatusResult.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\AbstractTransaction' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/AbstractTransaction.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\AbstractTransactionWithReference' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/AbstractTransactionWithReference.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\AddToCustomerProfileInterface' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/AddToCustomerProfileInterface.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\AddToCustomerProfileTrait' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/AddToCustomerProfileTrait.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\AmountableInterface' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/AmountableInterface.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\AmountableTrait' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/AmountableTrait.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\ItemsInterface' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/ItemsInterface.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\ItemsTrait' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/ItemsTrait.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\OffsiteInterface' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/OffsiteInterface.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\OffsiteTrait' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/OffsiteTrait.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\ScheduleInterface' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/ScheduleInterface.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Base\\ScheduleTrait' => __DIR__ . '/../../..' . '/classes/client/Transaction/Base/ScheduleTrait.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Capture' => __DIR__ . '/../../..' . '/classes/client/Transaction/Capture.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Debit' => __DIR__ . '/../../..' . '/classes/client/Transaction/Debit.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Deregister' => __DIR__ . '/../../..' . '/classes/client/Transaction/Deregister.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Error' => __DIR__ . '/../../..' . '/classes/client/Transaction/Error.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Payout' => __DIR__ . '/../../..' . '/classes/client/Transaction/Payout.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Preauthorize' => __DIR__ . '/../../..' . '/classes/client/Transaction/Preauthorize.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Refund' => __DIR__ . '/../../..' . '/classes/client/Transaction/Refund.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Register' => __DIR__ . '/../../..' . '/classes/client/Transaction/Register.php',
        'PaymentGatewayCloud\\Client\\Transaction\\Result' => __DIR__ . '/../../..' . '/classes/client/Transaction/Result.php',
        'PaymentGatewayCloud\\Client\\Transaction\\VoidTransaction' => __DIR__ . '/../../..' . '/classes/client/Transaction/VoidTransaction.php',
        'PaymentGatewayCloud\\Client\\Xml\\Generator' => __DIR__ . '/../../..' . '/classes/client/Xml/Generator.php',
        'PaymentGatewayCloud\\Client\\Xml\\Parser' => __DIR__ . '/../../..' . '/classes/client/Xml/Parser.php',
        'Psr\\Log\\AbstractLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/AbstractLogger.php',
        'Psr\\Log\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/log/Psr/Log/InvalidArgumentException.php',
        'Psr\\Log\\LogLevel' => __DIR__ . '/..' . '/psr/log/Psr/Log/LogLevel.php',
        'Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareInterface.php',
        'Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareTrait.php',
        'Psr\\Log\\LoggerInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerInterface.php',
        'Psr\\Log\\LoggerTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerTrait.php',
        'Psr\\Log\\NullLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/NullLogger.php',
        'Psr\\Log\\Test\\DummyTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\LoggerInterfaceTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\TestLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/TestLogger.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc3540edbd68b1df48d0447c874511d41::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc3540edbd68b1df48d0447c874511d41::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc3540edbd68b1df48d0447c874511d41::$classMap;

        }, null, ClassLoader::class);
    }
}
